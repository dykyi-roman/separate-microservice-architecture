<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder;

interface SmartTravelGatewayInterface
{
    /**
     * @throws \RuntimeException
     */
    public function readSmartTravel(int $travelId): FolderDto;

    /**
     * @throws \RuntimeException
     */
    public function createSmartTravel(string $title): int;

    /**
     * @throws \RuntimeException
     */
    public function updateSmartTravel(int $travelId, string $title): void;

    /**
     * @throws \RuntimeException
     */
    public function deleteSmartTravel(int $travelId): void;

    /**
     * @throws \RuntimeException
     */
    public function createQuery(int $travelId): int;
}
