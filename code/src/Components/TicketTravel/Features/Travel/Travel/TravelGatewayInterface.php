<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\Travel;

interface TravelGatewayInterface
{
    /**
     * @throws \RuntimeException
     */
    public function read(int $id): TravelDto;

    public function list(int $page, int $itemsPerPage, array $filters): TravelListDto;

    /**
     * @throws \RuntimeException
     */
    public function create(string $name, string $serviceId, string $methodId, string $strategy, int $status): int;

    /**
     * @throws \RuntimeException
     */
    public function update(int $id, string $name, string $serviceId, string $methodId, int $status): int;
}
