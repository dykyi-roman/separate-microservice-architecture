<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\TravelCost;

interface TravelCostGatewayInterface
{
    /**
     * @return TravelCostDto[]
     */
    public function listOfTravelCosts(int $tariffId): array;

    public function create(
        int $tariffId,
        string $name,
        float $limit,
        float $price,
        string $locationZoneId,
        int $smartFolderId,
        int $status
    ): int;

    public function update(
        int $id,
        string $name,
        float $limit,
        float $price,
        string $locationZoneId,
        int $smartFolderId,
        int $status
    ): int;
}
