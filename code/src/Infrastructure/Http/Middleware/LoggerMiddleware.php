<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http\Middleware;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

final class LoggerMiddleware
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function __invoke(callable $handler): callable
    {
        $logger = $this->logger;

        return static function (RequestInterface $request, array $options) use ($handler, $logger): PromiseInterface {
            $promise = $handler($request, $options);

            return $promise->then(
                function (ResponseInterface $response) use ($logger, $request) {
                    $request->getBody()->rewind();

                    $url = (string) $request->getUri();
                    $logger->info(sprintf('Request: %s', $url), [
                        'body' => $request->getBody()->getContents(),
                    ]);
                    $logger->info(sprintf('Response: %s', $url), [
                        'body' => $response->getBody()->getContents(),
                    ]);

                    $response->getBody()->rewind();

                    return $response;
                }
            );
        };
    }
}
