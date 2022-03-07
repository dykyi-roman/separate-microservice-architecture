<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\Gapi;

use Travel\Infrastructure\Http\Exception\ResponseException;
use RuntimeException;

final class ResponseAssert
{
    public static function hasErrors(array $response, string $key = 'errors'): void
    {
        if (array_key_exists($key, $response)) {
            throw new RuntimeException($response[$key]);
        }
    }

    public static function absentKey(array $response, string $key): void
    {
        if (!array_key_exists($key, $response)) {
            throw ResponseException::noKeyExist($key);
        }
    }

    public static function emptyKey(array $response, string $key): void
    {
        if (empty($response[$key])) {
            throw ResponseException::isEmpty($key);
        }
    }
}
