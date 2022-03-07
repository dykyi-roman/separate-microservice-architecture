<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\Seller;

/**
 * @psalm-immutable
 */
final class SellerDto
{
    public function __construct(
        public readonly int $travelId,
        public readonly int $owoxId,
        public readonly string $title
    ) {
    }
}
