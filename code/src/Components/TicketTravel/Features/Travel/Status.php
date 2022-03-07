<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel;

enum Status: int
{
    case ACTIVE = 1;
    case BLOCKED = 0;
    public static function name(int $id): ?string
    {
        return match ($id) {
            self::ACTIVE->value => 'Активный',
            self::BLOCKED->value => 'Заблокирован',
            default => null,
        };
    }
}
