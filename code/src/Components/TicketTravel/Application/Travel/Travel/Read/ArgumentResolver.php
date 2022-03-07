<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\Read;

final class ArgumentResolver
{
    public readonly int $id;

    public function __construct(array $arguments)
    {
        $this->id = (int) $arguments['id'];
    }
}
