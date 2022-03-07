<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\TravelCost\Update;

/**
 * @psalm-immutable
 */
final class Responder
{
    public function __invoke(array $data): array
    {
        return $data;
    }
}
