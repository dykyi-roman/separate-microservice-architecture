<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\LocationZone;

use Psr\Log\LoggerInterface;
use Symfony\Component\Uid\Uuid;
use Throwable;

final class FindLocationZone
{
    public function __construct(
        private LocationZoneGatewayInterface $locationZoneGateway,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @throws FindLocationsZoneException
     */
    public function findZoneByUuid(Uuid $zoneId): LocationZoneDto
    {
        try {
            return $this->locationZoneGateway->findById($zoneId);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => ['zoneId' => $zoneId->toRfc4122()]])
            );

            throw FindLocationsZoneException::notFindLocationZoneById($zoneId->toRfc4122());
        }
    }

    /**
     * @throws FindLocationsZoneException
     */
    public function findZoneByName(string $zoneName): array
    {
        if (empty($zoneName)) {
            throw FindLocationsZoneException::locationZoneNameIsEmpty();
        }

        try {
            return $this->locationZoneGateway->findByName($zoneName);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw FindLocationsZoneException::notFindLocationZoneByName($zoneName);
        }
    }
}
