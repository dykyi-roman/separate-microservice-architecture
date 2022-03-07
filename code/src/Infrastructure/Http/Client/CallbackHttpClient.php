<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http\Client;

use Closure;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class CallbackHttpClient implements HttpClientInterface
{
    public function __construct(private null|Closure $callback = null)
    {
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        if (null !== $this->callback) {
            call_user_func($this->callback, $request);
        }

        return new Response();
    }

    public function sendAsyncRequest(RequestInterface ...$requests): array
    {
        return array_map(static fn (RequestInterface $request): ResponseInterface => new Response(), $requests);
    }
}
