<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery;

use Travel\Infrastructure\Http\Exception\ResponseException;

final class ResponseAssert
{
    public static function absentKey(array $response, string $key): void
    {
        if (!array_key_exists($key, $response)) {
            throw ResponseException::noKeyExist($key);
        }
    }

    public static function emptyKey(array $response, string|int $key): void
    {
        if (empty($response[$key])) {
            throw ResponseException::isEmpty((string) $key);
        }
    }
}
