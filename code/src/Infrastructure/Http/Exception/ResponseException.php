<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http\Exception;

use RuntimeException;

/**
 * @psalm-immutable
 */
final class ResponseException
{
    public static function badRequest(string $message): RuntimeException
    {
        return new RuntimeException(sprintf('Bad request. Reason: %s', $message));
    }

    public static function hasNotValidJson(string $message): RuntimeException
    {
        return new RuntimeException(sprintf('Bad Response. Reason: %s', $message));
    }

    public static function noKeyExist(string $key): RuntimeException
    {
        return new RuntimeException(sprintf('Response does not has a key "%s"', $key));
    }

    public static function isEmpty(string $key): RuntimeException
    {
        return new RuntimeException(sprintf('Response key "%s" is empty.', $key));
    }

    public static function unknownError(string $message): RuntimeException
    {
        return new RuntimeException(sprintf('Unknown exception. Reason: %s', $message));
    }
}
