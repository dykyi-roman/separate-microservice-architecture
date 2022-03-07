<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\TravelCost\Read;

use Travel\Components\TicketTravel\Features\Travel\TravelCost\TravelCostManager;

final class Resolver
{
    public function __construct(private TravelCostManager $tariffCostManager)
    {
    }

    public function __invoke(ArgumentResolver $arguments): array
    {
        return $this->tariffCostManager->listOfTravelCosts($arguments->tariffId);
    }
}
