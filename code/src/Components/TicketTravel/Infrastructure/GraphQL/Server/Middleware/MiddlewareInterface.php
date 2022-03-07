<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Server\Middleware;

use Travel\Infrastructure\Http\Request;
use Travel\Infrastructure\Http\Response;

interface MiddlewareInterface
{
    public function execute(Request $request, Response $response): void;
}
