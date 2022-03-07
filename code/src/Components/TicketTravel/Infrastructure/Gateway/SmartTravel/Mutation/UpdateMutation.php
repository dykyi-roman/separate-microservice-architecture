<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation;

use GraphQL\Mutation;
use GraphQL\Query;
use GraphQL\RawObject;

/**
 * @psalm-immutable
 */
final class UpdateMutation
{
    public static function numberCondition(int $queryId, int $conditionId, string $numberConditions): Query
    {
        return (new Mutation('updateCondition'))->setArguments([
            'queryId' => $queryId,
            'conditionId' => $conditionId,
            'conditionLevel' => new RawObject('{parent: 0, level: 0, operator: ALL}'),
            'numberConditions' => new RawObject($numberConditions),
        ])->setSelectionSet(['id']);
    }

    public static function smartFolder(int $travelId, string $title): Query
    {
        return (new Mutation('updateSmartTravel'))->setArguments([
            'id' => $travelId,
            'title' => $title,
            'status' => new RawObject('ACTIVE'),
            'updatable' => false,
        ])->setSelectionSet(['id']);
    }

    public static function textCondition(int $queryId, int $conditionId, string $numberConditions): Query
    {
        return (new Mutation('updateCondition'))->setArguments([
            'queryId' => $queryId,
            'conditionId' => $conditionId,
            'conditionLevel' => new RawObject('{parent: 0, level: 0, operator: ALL}'),
            'textConditions' => new RawObject($numberConditions),
        ])->setSelectionSet(['id']);
    }

    public static function filter(
        int $queryId,
        int $conditionId,
        string $condition,
        string $operator,
        array $filters,
    ): Query {
        return (new Mutation('updateFilterGoods'))->setArguments([
            'queryId' => $queryId,
            'filterId' => $conditionId,
            'field' => new RawObject('CATEGORY'),
            'condition' => new RawObject($condition),
            'operator' => new RawObject($operator),
            'conditionLevel' => new RawObject('{parent: 0, level: 0, operator: ALL}'),
            'valueData' => array_map(static fn (mixed $filter): RawObject => new RawObject((string) $filter), $filters),
        ])->setSelectionSet(['id']);
    }
}
