<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Application;

use InvalidArgumentException;
use Symfony\Component\Uid\Uuid;

/**
 * @psalm-immutable
 */
final class ValidationAssert
{
    public static function keyExists(array $array, string $key, int $code): void
    {
        if (!(isset($array[$key]) || array_key_exists($key, $array))) {
            throw new InvalidArgumentException(sprintf('Expected the key "%s" to exist.', $key), $code);
        }
    }

    public static function isEmpty(string $value, int $code): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException(sprintf('The value should not be empty'), $code);
        }
    }

    public static function uuid(string $id, int $code): void
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('Invalid UUID: %s', $id), $code);
        }
    }
}
