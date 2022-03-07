<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\Read;

use Travel\Components\TicketTravel\Features\Travel\Travel\TravelDto;
use Travel\Components\TicketTravel\Features\Travel\Travel\TravelManager;

final class Resolver
{
    public function __construct(private TravelManager $tariffManager)
    {
    }

    public function __invoke(ArgumentResolver $arguments): TravelDto
    {
        return $this->tariffManager->read($arguments->id);
    }
}
