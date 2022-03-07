<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\Gapi;

use GuzzleHttp\Psr7\Request;
use Travel\Infrastructure\Helper\UrlHelper;
use Travel\Infrastructure\Http\Client\HttpClientInterface;
use Travel\Infrastructure\Http\HttpMethod;
use Psr\Http\Message\ResponseInterface;

final class GapiClient
{
    public function __construct(
        private string $gapiApiUrl,
        private string $gapiApiAuth,
        private HttpClientInterface $client
    ) {
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function get(string $urlPath, array $parameters): ResponseInterface
    {
        $headers = ['Authorization' => sprintf('Basic %s', base64_encode($this->gapiApiAuth))];

        return $this->client->sendRequest(
            new Request(
                HttpMethod::GET->value,
                sprintf(
                    '%s?%s',
                    UrlHelper::buildUrl($this->gapiApiUrl, $urlPath),
                    UrlHelper::buildQuery($parameters)
                ),
                $headers,
            )
        );
    }
}
