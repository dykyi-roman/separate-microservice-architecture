<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\TravelCost\Read;

final class ArgumentResolver
{
    public readonly int $tariffId;

    public function __construct(array $arguments)
    {
        $this->tariffId = (int) $arguments['tariffId'];
    }
}
