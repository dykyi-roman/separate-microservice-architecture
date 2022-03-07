<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel;

use GuzzleHttp\Psr7\Request;
use Travel\Infrastructure\Helper\UrlHelper;
use Travel\Infrastructure\Http\Client\HttpClientInterface;
use Travel\Infrastructure\Http\HttpMethod;
use Psr\Http\Message\ResponseInterface;

final class SmartTravelClient
{
    private array $headers;

    public function __construct(
        private string $smartFolderApiUrl,
        string $smartFolderApiToken,
        private HttpClientInterface $client,
    ) {
        $this->headers = ['x-auth-token' => $smartFolderApiToken];
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function get(string $body): ResponseInterface
    {
        return $this->client->sendRequest(
            new Request(HttpMethod::GET->value, UrlHelper::buildUrl($this->smartFolderApiUrl), $this->headers, $body)
        );
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function post(string $body): ResponseInterface
    {
        return $this->client->sendRequest(
            new Request(HttpMethod::POST->value, $this->smartFolderApiUrl, $this->headers, $body)
        );
    }
}
