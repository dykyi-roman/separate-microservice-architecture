<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\TravelCost;

use RuntimeException;

final class TravelCostException extends RuntimeException
{
    public static function failedToCreateTravelCost(string $name): self
    {
        return new self(
            sprintf('Failed to create tariff cost with name "%s".', $name),
            ErrorCode::FAILED_TO_CREATE_TRAVEL_COST->value
        );
    }

    public static function failedToUpdateTravelCost(string $name): self
    {
        return new self(
            sprintf('Failed to update tariff cost with name "%s".', $name), ErrorCode::FAILED_TO_UPDATE_TRAVEL_COST->value
        );
    }

    public static function failedToGetListOfTravelCosts(int $tariffId): self
    {
        return new self(sprintf('Failed to read tariff cost by tariffId "%d".', $tariffId), ErrorCode::FAILED_TO_READ_TRAVEL_COST->value);
    }

    public static function tariffCostAlreadyExists(string $name): self
    {
        return new self(
            sprintf('Travel cost already exists with name "%s".', $name), ErrorCode::TRAVEL_COST_ALREADY_EXISTS->value
        );
    }
}
