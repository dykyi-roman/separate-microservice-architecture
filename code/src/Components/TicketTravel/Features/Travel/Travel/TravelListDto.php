<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\Travel;

/**
 * @psalm-immutable
 */
final class TravelListDto
{
    /**
     * @param \Travel\Components\TicketTravel\Features\Travel\Travel\TravelDto[] $items
     */
    public function __construct(public readonly array $items, public readonly PaginationDto $pagination)
    {
    }
}
