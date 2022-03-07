<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment;

use Travel\Components\TicketTravel\Application\Segment\Category\ErrorCode;
use InvalidArgumentException;

/**
 * @psalm-immutable
 */
final class ValidationAssert
{
    public static function specSymbolExist(string $string): void
    {
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $string)) {
            throw new InvalidArgumentException(sprintf('Expected the string should not start from special characters "%s".', $string), ErrorCode::START_FROM_SPECIAL_SYMBOL->value);
        }
    }

    public static function isId(string $id, int $code): void
    {
        if (!is_numeric($id) || 0 >= (int) $id) {
            throw new InvalidArgumentException(sprintf('Expected the the "%s" be a ID type.', $id), $code);
        }
    }

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

    public static function keyIsArray(array $array, string $key, int $code): void
    {
        if (!is_array($array[$key])) {
            throw new InvalidArgumentException(sprintf('Expected the the "%s" be a array type.', $key), $code);
        }
    }

    public static function arrayNotEmpty(array $array, string $key, int $code): void
    {
        if (empty($array[$key])) {
            throw new InvalidArgumentException(sprintf('Expected the the "%s" array not be empty.', $key), $code);
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
}
