<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\Seller;

use Travel\Components\TicketTravel\Features\Segment\Seller\FindSeller;
use Travel\Components\TicketTravel\Features\Segment\Seller\FindSellerException;

final class Resolver
{
    public function __construct(private FindSeller $sellerFinder)
    {
    }

    public function __invoke(ArgumentResolver $argResolver): array
    {
        try {
            if (is_numeric($argResolver->value)) {
                return $this->sellerFinder->findSellerById((int) $argResolver->value);
            }

            return $this->sellerFinder->findSellersByText($argResolver->value);
        } catch (FindSellerException) {
            return [];
        }
    }
}
