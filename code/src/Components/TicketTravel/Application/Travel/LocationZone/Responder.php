<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\LocationZone;

use Travel\Components\TicketTravel\Features\Travel\LocationZone\LocationZoneDto;

/**
 * @psalm-immutable
 */
final class Responder
{
    public function __invoke(array $data): array
    {
        return array_map(static fn (LocationZoneDto $zoneDto): array => [
            'id' => $zoneDto->id,
            'name' => $zoneDto->name,
            'active' => $zoneDto->active,
        ], $data);
    }
}
