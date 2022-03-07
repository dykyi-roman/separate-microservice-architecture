<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\Seller;

use Travel\Components\TicketTravel\Features\Segment\Seller\SellerDto;

/**
 * @psalm-immutable
 */
final class Responder
{
    public function __invoke(array $sellers): array
    {
        return array_map(
            static fn (SellerDto $seller): array => [
                'travelId' => $seller->travelId,
                'owoxid' => $seller->owoxId,
                'title' => $seller->title,
            ],
            $sellers,
        );
    }
}
