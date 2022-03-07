<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Server\Middleware;

use Closure;
use Travel\Infrastructure\Http\Request;
use Travel\Infrastructure\Http\Response;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessageMiddleware implements MiddlewareInterface
{
    public function __construct(private MessageBusInterface $messageBus, private Closure $callback)
    {
    }

    public function execute(Request $request, Response $response): void
    {
        $command = call_user_func($this->callback, $request, $response);
        if (is_object($command)) {
            $this->messageBus->dispatch($command);
        }
    }
}
