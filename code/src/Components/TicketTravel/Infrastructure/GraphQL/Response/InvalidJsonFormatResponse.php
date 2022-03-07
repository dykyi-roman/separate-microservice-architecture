<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Response;

use Travel\Infrastructure\Http\HttpStatus;
use Travel\Infrastructure\Http\Response;

/**
 * @psalm-immutable
 */
final class InvalidJsonFormatResponse
{
    public static function create(string $message): Response
    {
        return new Response([
            'errors' => [
                [
                    'message' => sprintf(
                        'No schema or schema is invalid. Send request in GraphQL format. Reason: %s',
                        $message
                    ),
                    'code' => 1,
                ],
            ],
        ], HttpStatus::INTERNAL_SERVER_ERROR);
    }
}
