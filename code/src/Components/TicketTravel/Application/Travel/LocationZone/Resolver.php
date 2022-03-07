<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\LocationZone;

use Travel\Components\TicketTravel\Features\Travel\LocationZone\FindLocationsZoneException;
use Travel\Components\TicketTravel\Features\Travel\LocationZone\FindLocationZone;

final class Resolver
{
    public function __construct(private FindLocationZone $findLocationZone)
    {
    }

    public function __invoke(ArgumentResolver $arguments): array
    {
        try {
            if (is_string($arguments->value)) {
                return $this->findLocationZone->findZoneByName($arguments->value);
            }

            return [$this->findLocationZone->findZoneByUuid($arguments->value)];
        } catch (FindLocationsZoneException) {
            return [];
        }
    }
}
