<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\LocationZone;

use RuntimeException;

final class FindLocationsZoneException extends RuntimeException
{
    public static function notFindLocationZoneById(string $id): self
    {
        return new self(
            sprintf('Could not find location zone by value "%s".', $id), ErrorCode::LOCATION_ZONE_NOT_FOUND_BY_ID->value
        );
    }

    public static function notFindLocationZoneByName(string $value): self
    {
        return new self(
            sprintf('Could not find location zone by value "%s".', $value),
            ErrorCode::LOCATION_ZONE_NOT_FOUND_BY_NAME->value
        );
    }

    public static function locationZoneNameIsEmpty(): self
    {
        return new self('Location zone name is empty', ErrorCode::LOCATION_ZONE_NAME_IS_EMPTY->value);
    }

    public static function notFoundLocationZoneById(int $locationZoneId): self
    {
        return new self(sprintf('Location zone by ID "%d" not found', $locationZoneId));
    }
}
