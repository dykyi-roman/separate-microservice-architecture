<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\MapLocations;

use GraphQL\Query;
use Travel\Components\TicketTravel\Features\Travel\LocationZone\LocationZoneDto;
use Travel\Components\TicketTravel\Features\Travel\LocationZone\LocationZoneGatewayInterface;
use Travel\Components\TicketTravel\Infrastructure\Gateway\MapLocations\Query\ReadZoneById;
use Travel\Components\TicketTravel\Infrastructure\Gateway\MapLocations\Query\ReadZoneByName;
use Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\ResponseAssert;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\GraphQLGateway;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\QueryToJsonTransformer;
use Travel\Infrastructure\Cache\CacheItem;
use Travel\Infrastructure\Http\Exception\ResponseException;
use Travel\Infrastructure\Http\Exception\UnauthorizedException;
use Travel\Infrastructure\Http\HttpMethod;
use Travel\Infrastructure\Http\HttpStatus;
use Travel\Infrastructure\Http\ResponseExtractor\ResponseDataExtractorInterface;
use JsonException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Uid\Uuid;
use Throwable;

final class MapLocationsGateway extends GraphQLGateway implements LocationZoneGatewayInterface
{
    private const TOKEN_KEY = 'API_MAP_LOCATIONS_AUTH_TOKEN_KEY';

    public function __construct(
        private CacheItemPoolInterface $cacheItemPool,
        private MapLocationsClient $client,
        private ResponseDataExtractorInterface $dataExtractor
    ) {
        parent::__construct($dataExtractor);
    }

    public function findById(Uuid $id): LocationZoneDto
    {
        try {
            $response = $this->query(ReadZoneById::zone($id->toRfc4122()), HttpMethod::POST);
        } catch (UnauthorizedException) {
            $this->refreshToken();
            $response = $this->query(ReadZoneById::zone($id->toRfc4122()), HttpMethod::POST);
        }

        ResponseAssert::absentKey($response['data'], 'zone');
        ResponseAssert::isEmpty($response['data'], 'zone');

        return LocationZoneDto::fromArray($response['data']['zone']);
    }

    public function findByName(string $name): array
    {
        try {
            $response = $this->query(ReadZoneByName::zones($name), HttpMethod::POST);
        } catch (UnauthorizedException) {
            $this->refreshToken();
            $response = $this->query(ReadZoneByName::zones($name), HttpMethod::POST);
        }

        return array_map(
            static fn (array $zone) => LocationZoneDto::fromArray($zone),
            $response['data']['zones']
        );
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

    private function refreshToken(): string
    {
        $token = $this->login();
        $this->cacheItemPool->save(new CacheItem(self::TOKEN_KEY, $token));

        return $token;
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
