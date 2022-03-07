<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\JWT;

use Throwable;

final class JWTReader
{
    public function read(string $token): array
    {
        try {
            return (array) json_decode(
                base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $token)[1]))),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (Throwable) {
            return [];
        }
    }
}
