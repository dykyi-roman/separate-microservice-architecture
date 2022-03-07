<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel;

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

    public static function keyIsString(array $array, string $key, int $code): void
    {
        if (!is_string($array[$key])) {
            throw new InvalidArgumentException(sprintf('Expected the the "%s" be a string type.', $key), $code);
        }
    }

    public static function greaterThan(int $value, int $limit, int $code): void
    {
        if ($value < $limit) {
            throw new InvalidArgumentException(sprintf('Expected a value greater than %2$s. Got: %s', $value, $limit), $code);
        }
    }

    public static function lessThan(int $value, int $limit, int $code): void
    {
        if ($value > $limit) {
            throw new InvalidArgumentException(sprintf('Expected a value less than %2$s. Got: %s', $value, $limit), $code);
        }
    }

    public static function uuid(string $id, int $code): void
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('Invalid UUID: %s', $id), $code);
        }
    }
}
