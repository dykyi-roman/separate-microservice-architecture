<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\Seller;

use Psr\Log\LoggerInterface;
use Throwable;

final class FindSeller
{
    public function __construct(private SellerGatewayInterface $sellerGateway, private LoggerInterface $logger)
    {
    }

    /**
     * @throws FindSellerException
     */
    public function findSellerById(int $sellerId): array
    {
        try {
            return $this->sellerGateway->sellerById($sellerId);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw FindSellerException::couldNotFindSellerById($sellerId);
        }
    }

    /**
     * @throws FindSellerException
     */
    public function findSellersByText(string $sellerTitle): array
    {
        if (empty($sellerTitle)) {
            throw FindSellerException::titleIsEmpty();
        }

        try {
            return $this->sellerGateway->sellersByTitle($sellerTitle);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw FindSellerException::couldNotFindSellerByTitle($sellerTitle);
        }
    }
}
