<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel;

use InvalidArgumentException;

enum DeliveryService: string
{
    case NOVAPOSHTA = 'bdbbcc43-c4c5-4557-bf19-3ef4c76d6b17';
    case JUSTIN = '71a18feb-ae3d-4006-8b0a-d64c3be34c87';
    case UKRPOSHTA = 'd9409b7b-3535-4ab6-8492-2e11c78e93b8';
    case TRAVEL = 'cc917097-6f93-4199-b37c-383f04cedee6';
    case MEEST = '1a89d5af-c402-4938-a2f1-b2c1d042331a';
    case OCTOPUS = '4b0268af-06b5-4bee-8d0f-8f630d8f125b';
    public static function supported(string $serviceId, int $code): void
    {
        if (null === self::tryFrom($serviceId)) {
            throw new InvalidArgumentException(sprintf('Delivery service "%s" not supported', $serviceId), $code);
        }
    }

    public static function name(?string $id): ?string
    {
        return match ($id) {
            self::NOVAPOSHTA->value => 'Новая Почта',
            self::JUSTIN->value => 'Джастин',
            self::UKRPOSHTA->value => 'Укрпочта',
            self::TRAVEL->value => 'Деливери',
            self::MEEST->value => 'Мист Экспресс',
            self::OCTOPUS->value => 'Октопус',
            default => null,
        };
    }
}
