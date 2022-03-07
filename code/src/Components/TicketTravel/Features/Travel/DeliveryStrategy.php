<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel;

use InvalidArgumentException;

enum DeliveryStrategy: string
{
    case BY_WEIGHT = 'by_weight';
    case BY_COST_LIMIT = 'by_cost_limit';
    public static function supported(string $serviceId, int $code): void
    {
        if (null === self::tryFrom($serviceId)) {
            throw new InvalidArgumentException(sprintf('Delivery strategy "%s" not supported', $serviceId), $code);
        }
    }

    public static function name(string $strategy): ?string
    {
        return match ($strategy) {
            self::BY_WEIGHT->value => 'По весу',
            self::BY_COST_LIMIT->value => 'По цене',
            default => null,
        };
    }
}
