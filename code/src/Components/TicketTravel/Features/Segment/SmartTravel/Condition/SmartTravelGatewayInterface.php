<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition;

interface SmartTravelGatewayInterface
{
    /**
     * @throws \RuntimeException
     */
    public function createNumberCondition(int $queryId, string $condition): int;

    /**
     * @throws \RuntimeException
     */
    public function createTextCondition(int $queryId, string $condition): int;

    /**
     * @throws \RuntimeException
     */
    public function updateNumberCondition(int $queryId, int $conditionId, string $condition): int;

    /**
     * @throws \RuntimeException
     */
    public function updateTextCondition(int $queryId, int $conditionId, string $condition): int;

    /**
     * @throws \RuntimeException
     */
    public function createFilter(int $queryId, string $condition, string $operator, array $filters): int;

    /**
     * @throws \RuntimeException
     */
    public function updateFilter(
        int $queryId,
        int $conditionId,
        string $condition,
        string $operator,
        array $filters
    ): int;

    /**
     * @throws \RuntimeException
     */
    public function deleteFilter(int $queryId, int $filterId): void;

    /**
     * @throws \RuntimeException
     */
    public function deleteCondition(int $queryId, int $conditionId, string $conditionType): void;

    /**
     * @throws \RuntimeException
     */
    public function filtersExecute(int $queryId): void;
}
