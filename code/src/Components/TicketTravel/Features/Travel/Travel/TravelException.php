<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\Travel;

use RuntimeException;

final class TravelException extends RuntimeException
{
    public static function failedToCreateTravel(string $name): self
    {
        return new self(
            sprintf('Failed to create tariff with name "%s".', $name), ErrorCode::FAILED_TO_CREATE_TRAVEL->value
        );
    }

    public static function failedToUpdateTravel(string $name): self
    {
        return new self(
            sprintf('Failed to update tariff with name "%s".', $name), ErrorCode::FAILED_TO_UPDATE_TRAVEL->value
        );
    }

    public static function failedToReadTravel(int $id): self
    {
        return new self(sprintf('Failed to read tariff by id "%d".', $id), ErrorCode::FAILED_TO_READ_TRAVEL->value);
    }

    public static function failedToReadTravelList(int $page, int $itemsPerPage): self
    {
        return new self(
            sprintf('Failed to read tariff list by page - "%d"; itemsPerPage - "%d"', $page, $itemsPerPage),
            ErrorCode::FAILED_TO_READ_TRAVEL_LIST->value
        );
    }

    public static function tariffAlreadyExists(string $name): self
    {
        return new self(
            sprintf('Travel already exists with name "%s".', $name), ErrorCode::TRAVEL_ALREADY_EXISTS->value
        );
    }

    public static function unableToActivateTravel(int $id): self
    {
        return new self(
            sprintf('Unable to activate tariff ID - "%d".', $id),
            ErrorCode::UNABLE_TO_ACTIVATE_TRAVEL->value
        );
    }

    public static function unableToActivateNewTravel(string $name): self
    {
        return new self(
            sprintf('Unable to activate new tariff with name - "%s".', $name),
            ErrorCode::UNABLE_TO_ACTIVATE_TRAVEL->value
        );
    }
}
