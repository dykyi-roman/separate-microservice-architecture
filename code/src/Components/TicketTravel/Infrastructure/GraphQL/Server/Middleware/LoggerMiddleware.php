<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Server\Middleware;

use Travel\Infrastructure\Http\Request;
use Travel\Infrastructure\Http\Response;
use Psr\Log\LoggerInterface;

final class LoggerMiddleware implements MiddlewareInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function execute(Request $request, Response $response): void
    {
        $this->logger->info('GraphQL server request', [
            'request' => $request->content,
            'response' => $response->data,
            'status' => $response->status,
        ]);
    }
}
