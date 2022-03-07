<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\Seller;

interface SellerGatewayInterface
{
    /**
     * @throws \RuntimeException
     *
     * @return SellerDto[]
     */
    public function sellerById(int $sellerId): array;

    /**
     * @throws \RuntimeException
     *
     * @return SellerDto[]
     */
    public function sellersByTitle(string $title): array;
}
