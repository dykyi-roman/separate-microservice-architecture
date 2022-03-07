<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Authentification;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

final class UnauthorizedException extends UnauthorizedHttpException
{
    public static function invalidToken(): self
    {
        return new self('Invalid token', 'Invalid token', null, ErrorCode::TOKEN_IS_INVALID->value);
    }

    public static function expireToken(): self
    {
        return new self('Expire token', 'Expire token', null, ErrorCode::TOKEN_IS_EXPIRED->value);
    }

    public static function missingToken(string $token): self
    {
        $message = sprintf('Missing token "%s', $token);

        return new self($message, $message, null, ErrorCode::TOKEN_IS_MISSING->value);
    }
}
