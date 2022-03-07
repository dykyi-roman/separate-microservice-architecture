<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL;

use Travel\Infrastructure\Http\Exception\ResponseException;
use RuntimeException;

final class ResponseAssert
{
    public static function hasErrors(array $response): void
    {
        if (array_key_exists('errors', $response)) {
            $error = array_shift($response['errors']);

            throw new RuntimeException(is_array($error) ? array_shift($error) : $error);
        }
    }

    public static function absentKey(array $response, string $key): void
    {
        if (!array_key_exists($key, $response)) {
            throw ResponseException::noKeyExist($key);
        }
    }
}
