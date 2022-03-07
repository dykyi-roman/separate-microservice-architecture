<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\MapLocations;

use GuzzleHttp\Psr7\Request;
use Travel\Infrastructure\Helper\UrlHelper;
use Travel\Infrastructure\Http\Client\HttpClientInterface;
use Travel\Infrastructure\Http\HttpMethod;
use Psr\Http\Message\ResponseInterface;

final class MapLocationsClient
{
    public function __construct(
        private string $MapLocationsApiUrl,
        private string $MapLocationsApiUserName,
        private string $MapLocationsApiPassword,
        private HttpClientInterface $client
    ) {
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function login(string $urlPath): ResponseInterface
    {
        return $this->client->sendRequest(
            new Request(
                HttpMethod::POST->value,
                UrlHelper::buildUrl($this->MapLocationsApiUrl, $urlPath),
                ['Content-Type' => 'application/json'],
                json_encode([
                    'username' => $this->MapLocationsApiUserName,
                    'password' => $this->MapLocationsApiPassword,
                ], JSON_THROW_ON_ERROR)
            ),
        );
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function get(string $body, string $token): ResponseInterface
    {
        return $this->send($body, $token, HttpMethod::GET);
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function post(string $body, string $token): ResponseInterface
    {
        return $this->send($body, $token, HttpMethod::POST);
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    private function send(string $body, string $token, HttpMethod $method): ResponseInterface
    {
        $url = sprintf('%s?%s', $this->MapLocationsApiUrl, UrlHelper::buildQuery(['token' => $token]));

        return $this->client->sendRequest(
            new Request(
                $method->value, $url, ['Content-Type' => 'application/json'], $body,
            ),
        );
    }
}
