<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\Travel;

use Psr\Log\LoggerInterface;
use Throwable;

final class TravelManager
{
    public function __construct(private TravelGatewayInterface $tariffGateway, private LoggerInterface $logger)
    {
    }

    public function list(int $page, int $itemsPerPage, array $filters): TravelListDto
    {
        try {
            return $this->tariffGateway->list($page, $itemsPerPage, $filters);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw TravelException::failedToReadTravelList($page, $itemsPerPage);
        }
    }

    public function read(int $id): TravelDto
    {
        try {
            return $this->tariffGateway->read($id);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw TravelException::failedToReadTravel($id);
        }
    }

    public function create(string $name, string $serviceId, string $methodId, string $strategy, int $status): int
    {
        try {
            return $this->tariffGateway->create($name, $serviceId, $methodId, $strategy, $status);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            TravelAssert::tariffExist($name, $exception->getMessage());
            TravelAssert::newTravelActivation($name, $exception->getMessage());

            throw TravelException::failedToCreateTravel($name);
        }
    }

    public function update(int $id, string $name, string $serviceId, string $methodId, int $status): int
    {
        try {
            return $this->tariffGateway->update($id, $name, $serviceId, $methodId, $status);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            TravelAssert::tariffExist($name, $exception->getMessage());
            TravelAssert::tariffActivation($id, $exception->getMessage());

            throw TravelException::failedToUpdateTravel($name);
        }
    }
}
