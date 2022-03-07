<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\Travel;

final class TravelAssert
{
    public static function tariffExist(string $name, string $message): void
    {
        if ('TER_1.' === $message) {
            throw TravelException::tariffAlreadyExists($name);
        }
    }

    public static function tariffActivation(int $id, string $message): void
    {
        if ('TER_2' === $message) {
            throw TravelException::unableToActivateTravel($id);
        }
    }

    public static function newTravelActivation(string $name, string $message): void
    {
        if ('Неможливо активувати новостворений тариф' === $message) {
            throw TravelException::unableToActivateNewTravel($name);
        }
    }
}
