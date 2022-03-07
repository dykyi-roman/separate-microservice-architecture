<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\TravelCost\Read;

use Travel\Components\TicketTravel\Features\Travel\TravelCost\TravelCostDto;

/**
 * @psalm-immutable
 */
final class Responder
{
    /**
     * @param TravelCostDto[] $tariffCosts
     */
    public function __invoke(array $tariffCosts): array
    {
        return array_map(static fn (TravelCostDto $dto): array => $dto->jsonSerialize(), $tariffCosts);
    }
}
