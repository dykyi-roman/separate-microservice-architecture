<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Response;

use Travel\Infrastructure\Http\HttpStatus;
use Travel\Infrastructure\Http\Response;

/**
 * @psalm-immutable
 */
final class UnexpectedExceptionResponse
{
    public static function create(string $message): Response
    {
        return new Response([
            'errors' => [
                [
                    'message' => sprintf('Unexpected exception. Reason: "%s"', $message),
                    'code' => 3,
                ],
            ],
        ], HttpStatus::INTERNAL_SERVER_ERROR);
    }
}
