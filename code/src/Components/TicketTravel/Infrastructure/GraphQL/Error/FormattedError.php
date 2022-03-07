<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Error;

use Throwable;

/**
 * @psalm-immutable
 */
final class FormattedError
{
    public static function createFromException(Throwable $exception): array
    {
        $previous = $exception->getPrevious();

        return [
            'message' => $exception->getMessage(),
            'code' => null === $previous ? $exception->getCode() : $previous->getCode(),
        ];
    }
}
