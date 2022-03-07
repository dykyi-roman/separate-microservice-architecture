<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\TravelCost;

use Psr\Log\LoggerInterface;
use Symfony\Component\Uid\Uuid;
use Throwable;

final class TravelCostManager
{
    public function __construct(
        private TravelCostGatewayInterface $tariffCostGateway,
        private LoggerInterface $logger
    ) {
    }

    public function create(
        int $tariffId,
        string $name,
        float $limit,
        float $price,
        Uuid $locationZoneId,
        int $smartFolderId,
        int $status
    ): int {
        try {
            return $this->tariffCostGateway->create(
                $tariffId,
                $name,
                $limit,
                $price,
                $locationZoneId->toRfc4122(),
                $smartFolderId,
                $status
            );
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            TravelCostAssert::tariffCostExist($name, $exception->getMessage());

            throw TravelCostException::failedToCreateTravelCost($name);
        }
    }

    public function update(
        int $id,
        string $name,
        float $limit,
        float $price,
        Uuid $locationZoneId,
        int $smartFolderId,
        int $status
    ): int {
        try {
            return $this->tariffCostGateway->update(
                $id,
                $name,
                $limit,
                $price,
                $locationZoneId->toRfc4122(),
                $smartFolderId,
                $status
            );
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            TravelCostAssert::tariffCostExist($name, $exception->getMessage());

            throw TravelCostException::failedToUpdateTravelCost($name);
        }
    }

    /**
     * @return TravelCostDto[]
     */
    public function listOfTravelCosts(int $tariffId): array
    {
        try {
            return $this->tariffCostGateway->listOfTravelCosts($tariffId);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw TravelCostException::failedToGetListOfTravelCosts($tariffId);
        }
    }
}
