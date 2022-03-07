<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\InterCard;

use Travel\Components\TicketTravel\Features\Segment\Seller\SellerDto;
use Travel\Components\TicketTravel\Features\Segment\Seller\SellerGatewayInterface;
use Travel\Infrastructure\Http\Exception\ResponseException;
use Travel\Infrastructure\Http\HttpStatus;
use Travel\Infrastructure\Http\ResponseExtractor\ResponseDataExtractorInterface;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

final class InterCardGateway implements SellerGatewayInterface
{
    public function __construct(private InterCardClient $client, private ResponseDataExtractorInterface $dataExtractor)
    {
    }

    /**
     * @return SellerDto[]
     */
    public function sellersByTitle(string $title): array
    {
        try {
            $response = $this->client->get('', ['company_name' => $title]);
            $payload = $this->dataExtractor->extract($response);
        } catch (ClientExceptionInterface $exception) {
            throw ResponseException::badRequest($exception->getMessage());
        } catch (JsonException $exception) {
            throw ResponseException::hasNotValidJson($exception->getMessage());
        } catch (Throwable $exception) {
            throw ResponseException::unknownError($exception->getMessage());
        }

        ResponseAssert::isEmpty($payload);
        ResponseAssert::hasErrors($payload, 'Not Found (#404)');
        ResponseAssert::hasErrors($payload, 'message');

        return array_map(
            static fn (array $seller) => new SellerDto(
                (int) $seller['travel_id'],
                (int) $seller['owox_account_id'],
                $seller['company_name'],
            ),
            $payload
        );
    }

    public function sellerById(int $sellerId): array
    {
        $payloads = $this->extractResponses($this->responses($sellerId));

        $result = [];
        foreach ($payloads as $payload) {
            $payload = array_key_exists(0, $payload) ? $payload[0] : $payload;

            ResponseAssert::hasErrors($payload, 'Not Found (#404)');
            ResponseAssert::hasErrors($payload, 'message');

            if (count($payload)) {
                $result[] = new SellerDto(
                    (int) $payload['travel_id'],
                    (int) $payload['owox_account_id'],
                    $payload['company_name'],
                );
            }
        }

        return $result;
    }

    private function responses(int $sellerId): array
    {
        try {
            $responses = $this->client->getAsync([
                sprintf('/?owox_account_id=%d', $sellerId),
                sprintf('/%d', $sellerId),
            ]);

            return array_filter(
                $responses,
                static fn (ResponseInterface $response): bool => HttpStatus::OK->value === $response->getStatusCode()
            );
        } catch (Throwable $exception) {
            throw ResponseException::badRequest($exception->getMessage());
        }
    }

    private function extractResponses(array $responses): array
    {
        $payloads = [];
        try {
            foreach ($responses as $response) {
                $payloads[] = $this->dataExtractor->extract($response);
            }
        } catch (JsonException $exception) {
            throw ResponseException::hasNotValidJson($exception->getMessage());
        }

        return $payloads;
    }
}
