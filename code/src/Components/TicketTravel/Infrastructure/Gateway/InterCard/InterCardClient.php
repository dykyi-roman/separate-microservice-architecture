<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\InterCard;

use GuzzleHttp\Psr7\Request;
use Travel\Infrastructure\Helper\UrlHelper;
use Travel\Infrastructure\Http\Client\HttpClientInterface;
use Travel\Infrastructure\Http\HttpMethod;
use Psr\Http\Message\ResponseInterface;

final class InterCardClient
{
    public function __construct(
        private string $interCardApiUrl,
        private string $interCardApiAuth,
        private HttpClientInterface $client
    ) {
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function get(string $urlPath, array $parameters = []): ResponseInterface
    {
        $headers = ['Authorization' => sprintf('Basic %s', base64_encode($this->interCardApiAuth))];

        return $this->client->sendRequest(
            new Request(
                HttpMethod::GET->value, sprintf(
                '%s?%s',
                UrlHelper::buildUrl($this->interCardApiUrl, $urlPath),
                UrlHelper::buildQuery($parameters)
            ), $headers,
            )
        );
    }

    public function getAsync(array $urlPaths): array
    {
        $headers = ['Authorization' => sprintf('Basic %s', base64_encode($this->interCardApiAuth))];

        $requests = [];
        foreach ($urlPaths as $urlPath) {
            $requests[] = new Request(
                HttpMethod::GET->value,
                UrlHelper::buildUrl($this->interCardApiUrl, $urlPath),
                $headers
            );
        }

        return $this->client->sendAsyncRequest(...$requests);
    }
}
