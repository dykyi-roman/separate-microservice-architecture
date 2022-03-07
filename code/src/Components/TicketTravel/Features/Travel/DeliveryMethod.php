<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel;

use InvalidArgumentException;

enum DeliveryMethod: string
{
    case PICKUP = 'b270e4b3-57dc-40d9-8996-188dca234dc6';
    case COURIER = 'dfc7ab36-e40d-4770-beeb-f0fe6aba405d';
    case VIRTUAL_TRAVEL = 'e2215285-bb61-47e0-93ad-cfa4b8f7b68a';
    public static function supported(string $methodId, int $code): void
    {
        if (null === self::tryFrom($methodId)) {
            throw new InvalidArgumentException(sprintf('Delivery method "%s" not supported', $methodId), $code);
        }
    }

    public static function name(string $id): ?string
    {
        return match ($id) {
            self::PICKUP->value => 'Отделение',
            self::COURIER->value => 'Курьер',
            self::VIRTUAL_TRAVEL->value => 'Виртуальная доставка',
            default => null,
        };
    }
}
