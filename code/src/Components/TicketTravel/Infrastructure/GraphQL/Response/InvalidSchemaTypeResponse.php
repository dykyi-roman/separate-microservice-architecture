<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Response;

use Travel\Infrastructure\Http\HttpStatus;
use Travel\Infrastructure\Http\Response;

/**
 * @psalm-immutable
 */
final class InvalidSchemaTypeResponse
{
    public static function create(string $message): Response
    {
        return new Response([
            'errors' => [
                [
                    'message' => sprintf('Invalid schema type. Reason: %s', $message),
                    'code' => 2,
                ],
            ],
        ], HttpStatus::INTERNAL_SERVER_ERROR);
    }
}
