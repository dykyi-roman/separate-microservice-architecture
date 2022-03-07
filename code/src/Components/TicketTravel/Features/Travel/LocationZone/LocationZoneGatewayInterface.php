<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\LocationZone;

use Symfony\Component\Uid\Uuid;

interface LocationZoneGatewayInterface
{
    /**
     * @throws \RuntimeException
     */
    public function findById(Uuid $id): LocationZoneDto;

    /**
     * @throws \RuntimeException
     *
     * @return LocationZoneDto[]
     */
    public function findByName(string $name): array;
}
