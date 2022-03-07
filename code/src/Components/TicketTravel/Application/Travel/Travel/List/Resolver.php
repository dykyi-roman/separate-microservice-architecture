<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\List;

use Travel\Components\TicketTravel\Features\Travel\Travel\TravelListDto;
use Travel\Components\TicketTravel\Features\Travel\Travel\TravelManager;

final class Resolver
{
    public function __construct(private TravelManager $tariffManager)
    {
    }

    public function __invoke(ArgumentResolver $arguments): TravelListDto
    {
        return $this->tariffManager->list($arguments->page, $arguments->itemsPerPage, $arguments->filters);
    }
}
