<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http;

enum HttpStatus: int
{
    case OK = 200;
    case UNAUTHORIZED = 401;
    case ACCESS_DENIED = 403;
    case NOT_FOUND = 404;
    case INTERNAL_SERVER_ERROR = 500;
    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function isSuccess(int $code): bool
    {
        return self::OK->value === $code;
    }

    public static function isUnauthorized(int $code): bool
    {
        return self::UNAUTHORIZED->value === $code;
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::OK => 'OK',
            self::ACCESS_DENIED => 'Access Denied',
            self::NOT_FOUND => 'Page Not Found',
            self::UNAUTHORIZED => 'Unauthorized',
            self::INTERNAL_SERVER_ERROR => 'Internal Server Error',
        };
    }
}
