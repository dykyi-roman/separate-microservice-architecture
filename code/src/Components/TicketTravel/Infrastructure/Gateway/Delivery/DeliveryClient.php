<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery;

use GuzzleHttp\Psr7\Request;
use Travel\Infrastructure\Helper\UrlHelper;
use Travel\Infrastructure\Http\Client\HttpClientInterface;
use Travel\Infrastructure\Http\HttpMethod;
use Psr\Http\Message\ResponseInterface;

final class DeliveryClient
{
    private array $headers;

    public function __construct(
        private string $travelApiUrl,
        string $travelApiAuth,
        private HttpClientInterface $client,
    ) {
        $this->headers = ['Authorization' => sprintf('Basic %s', base64_encode($travelApiAuth))];
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function get(string $body): ResponseInterface
    {
        return $this->client->sendRequest(
            new Request(HttpMethod::GET->value, UrlHelper::buildUrl($this->travelApiUrl), $this->headers, $body)
        );
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function post(string $body): ResponseInterface
    {
        return $this->client->sendRequest(
            new Request(HttpMethod::POST->value, $this->travelApiUrl, $this->headers, $body)
        );
    }
}
