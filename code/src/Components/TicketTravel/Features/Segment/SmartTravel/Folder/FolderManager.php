<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder;

use Psr\Log\LoggerInterface;
use Throwable;

final class FolderManager
{
    public function __construct(private SmartTravelGatewayInterface $smartFolderGateway, private LoggerInterface $logger)
    {
    }

    public function read(int $travelId): FolderDto
    {
        try {
            return $this->smartFolderGateway->readSmartTravel($travelId);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw FolderException::failedToReadSmartTravel($travelId);
        }
    }

    public function create(string $title): int
    {
        try {
            return $this->smartFolderGateway->createSmartTravel($title);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw FolderException::failedToCreateSmartTravel($title);
        }
    }

    public function rename(int $travelId, string $title): void
    {
        try {
            $this->smartFolderGateway->updateSmartTravel($travelId, $title);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw FolderException::failedToUpdateSmartTravel($title);
        }
    }

    public function addQuery(int $smartFolderId): int
    {
        try {
            return $this->smartFolderGateway->createQuery($smartFolderId);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw FolderException::failedToCreateQuery($smartFolderId);
        }
    }

    public function delete(int $smartFolderId): void
    {
        try {
            $this->smartFolderGateway->deleteSmartTravel($smartFolderId);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw FolderException::failedToDeleteSmartTravel();
        }
    }
}
