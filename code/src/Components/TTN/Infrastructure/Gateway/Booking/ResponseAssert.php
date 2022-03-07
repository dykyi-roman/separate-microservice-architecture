<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Infrastructure\Gateway\Booking;

use RuntimeException;

final class ResponseAssert
{
    public static function isEmpty(array $array, string $key): void
    {
        if (empty($array[$key])) {
            throw new RuntimeException(sprintf('Not Found data by key "%s"', $key));
        }
    }

    public static function absentKey(array $response, string $key): void
    {
        if (!array_key_exists($key, $response)) {
            throw new RuntimeException(sprintf('Key "%s" is absent', $key));
        }
    }
}
