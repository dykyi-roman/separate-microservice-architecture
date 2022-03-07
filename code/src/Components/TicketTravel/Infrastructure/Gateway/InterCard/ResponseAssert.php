<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\InterCard;

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

    public static function isEmpty(array $response): void
    {
        if (empty($response)) {
            throw ResponseException::isEmpty('');
        }
    }
}
