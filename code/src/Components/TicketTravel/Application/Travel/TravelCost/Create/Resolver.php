<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\TravelCost\Create;

use Travel\Components\TicketTravel\Features\Travel\TravelCost\TravelCostManager;

final class Resolver
{
    public function __construct(private TravelCostManager $tariffCostManager)
    {
    }

    public function __invoke(ArgumentResolver $arguments): array
    {
        return [
            'id' => $this->tariffCostManager->create(
                $arguments->tariffId,
                $arguments->name,
                $arguments->limit,
                $arguments->price,
                $arguments->locationZoneId,
                $arguments->smartFolderId,
                $arguments->status,
            ),
        ];
    }
}
