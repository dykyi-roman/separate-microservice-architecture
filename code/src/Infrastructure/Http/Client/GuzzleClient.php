<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\Utils;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class GuzzleClient implements HttpClientInterface
{
    private const TIMEOUT = 5.0;
    private const CONNECT_TIMEOUT = 5.0;

    public function __construct(private ClientInterface $client, private array $middleware)
    {
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->client->send($request, $this->options($request->getHeaders()));
    }

    public function sendAsyncRequest(RequestInterface ...$requests): array
    {
        $promises = [];
        foreach ($requests as $request) {
            $promises[] = $this->client->sendAsync($request, $this->options($request->getHeaders()));
        }

        return Utils::unwrap($promises);
    }

    private function options(array $headers): array
    {
        return [
            'verify' => false,
            'http_errors' => false,
            'timeout' => self::TIMEOUT,
            'connect_timeout' => self::CONNECT_TIMEOUT,
            'handler' => $this->handlerStack(),
            'headers' => array_merge(
                [
                    'Content-Type' => 'application/json',
                ],
                $headers,
            ),
        ];
    }

    private function handlerStack(): HandlerStack
    {
        $handlerStack = HandlerStack::create();
        foreach ($this->middleware as $middleware) {
            $handlerStack->push($middleware);
        }

        return $handlerStack;
    }
}
