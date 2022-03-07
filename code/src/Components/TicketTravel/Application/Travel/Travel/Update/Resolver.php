<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\Update;

use Travel\Components\TicketTravel\Features\Travel\Travel\TravelManager;

final class Resolver
{
    public function __construct(private TravelManager $tariffManager)
    {
    }

    public function __invoke(ArgumentResolver $arguments): array
    {
        return [
            'id' => $this->tariffManager->update(
                $arguments->id,
                $arguments->name,
                $arguments->serviceId,
                $arguments->methodId,
                $arguments->status,
            ),
        ];
    }
}
