<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\Create;

use Travel\Components\TicketTravel\Features\Travel\Travel\TravelManager;

final class Resolver
{
    public function __construct(private TravelManager $tariffManager)
    {
    }

    public function __invoke(ArgumentResolver $arguments): array
    {
        return [
            'id' => $this->tariffManager->create(
                $arguments->name,
                $arguments->serviceId,
                $arguments->methodId,
                $arguments->strategy,
                $arguments->status
            ),
        ];
    }
}
