<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\TravelCost;

final class TravelCostAssert
{
    public static function tariffCostExist(string $name, string $message): void
    {
        if ('Тарифна вартість з заданою назвою вже існує.' === $message) {
            throw TravelCostException::tariffCostAlreadyExists($name);
        }
    }
}
