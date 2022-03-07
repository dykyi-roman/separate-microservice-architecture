<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Infrastructure\Gateway\Booking;

use GraphQL\Query;
use Travel\Components\TTN\Features\TrackDelivery\ExpressNote;
use Travel\Components\TTN\Features\TrackDelivery\TrackDeliveryGatewayInterface;
use Travel\Components\TTN\Infrastructure\Gateway\Booking\Mutation\UpdateQuery;
use Travel\Components\TTN\Infrastructure\GraphQL\GraphQLGateway;
use Travel\Components\TTN\Infrastructure\GraphQL\QueryToJsonTransformer;
use Travel\Infrastructure\Cache\CacheItem;
use Travel\Infrastructure\Http\Exception\ResponseException;
use Travel\Infrastructure\Http\Exception\UnauthorizedException;
use Travel\Infrastructure\Http\HttpStatus;
use Travel\Infrastructure\Http\ResponseExtractor\ResponseDataExtractorInterface;
use JsonException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

final class TrackDeliveryGateway extends GraphQLGateway implements TrackDeliveryGatewayInterface
{
    private const TOKEN_KEY = 'API_CENT_AUTH_TOKEN_KEY';

    public function __construct(
        private ResponseDataExtractorInterface $dataExtractor,
        private BookingClient $client,
        private CacheItemPoolInterface $cacheItemPool
    ) {
        parent::__construct($dataExtractor);
    }

    /**
     * @throws \RuntimeException
     */
    public function track(ExpressNote $expressNote, bool $async = false): void
    {
        try {
            $response = $this->mutation(UpdateQuery::track($expressNote, $async));
        } catch (UnauthorizedException) {
            $this->refreshToken();
            $response = $this->mutation(UpdateQuery::track($expressNote, $async));
        }

        ResponseAssert::absentKey($response['data'], 'track');
        ResponseAssert::isEmpty($response['data'], 'track');
    }

    public function trackCollection(ExpressNote ...$expressNotes): void
    {
        try {
            $response = $this->mutation(UpdateQuery::trackCollection(...$expressNotes));
        } catch (UnauthorizedException) {
            $this->refreshToken();
            $response = $this->mutation(UpdateQuery::trackCollection(...$expressNotes));
        }

        ResponseAssert::absentKey($response['data'], 'trackCollection');
        ResponseAssert::isEmpty($response['data'], 'trackCollection');
    }

    private function refreshToken(): string
    {
        $token = $this->login();
        $this->cacheItemPool->save(new CacheItem(self::TOKEN_KEY, $token));

        return $token;
    }

    public function get(Query $query): ResponseInterface
    {
        $item = $this->cacheItemPool->getItem(self::TOKEN_KEY);
        !$item->isHit() && $this->refreshToken();

        $response = $this->client->get((string) new QueryToJsonTransformer($query), (string) $item->get());
        if (HttpStatus::isUnauthorized($response->getStatusCode())) {
            throw new UnauthorizedException();
        }

        return $response;
    }

    public function post(Query $mutation): ResponseInterface
    {
        $item = $this->cacheItemPool->getItem(self::TOKEN_KEY);
        !$item->isHit() && $this->refreshToken();

        $response = $this->client->post((string) new QueryToJsonTransformer($mutation), (string) $item->get());

        if (HttpStatus::isUnauthorized($response->getStatusCode())) {
            throw new UnauthorizedException();
        }

        return $response;
    }

    private function login(): string
    {
        try {
            $response = $this->client->login('/auth/login');
            $payload = $this->dataExtractor->extract($response);

            return $payload['token'];
        } catch (ClientExceptionInterface $exception) {
            throw ResponseException::badRequest($exception->getMessage());
        } catch (JsonException $exception) {
            throw ResponseException::hasNotValidJson($exception->getMessage());
        } catch (Throwable $exception) {
            throw ResponseException::unknownError($exception->getMessage());
        }
    }
}
