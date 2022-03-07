<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation;

use GraphQL\Mutation;
use GraphQL\Query;
use GraphQL\RawObject;

/**
 * @psalm-immutable
 */
final class CreateMutation
{
    public static function numberCondition(int $queryId, string $numberConditions): Query
    {
        return (new Mutation('addCondition'))->setArguments([
            'queryId' => $queryId,
            'conditionLevel' => new RawObject('{parent: 0, level: 0, operator: ALL}'),
            'numberConditions' => new RawObject($numberConditions),
        ])->setSelectionSet(['... on NumberCondition { id }']);
    }

    public static function filter(int $queryId, string $condition, string $operator, array $filters): Query
    {
        return (new Mutation('createFilterGoods'))->setArguments([
            'queryId' => $queryId,
            'field' => new RawObject('CATEGORY'),
            'condition' => new RawObject($condition),
            'operator' => new RawObject($operator),
            'conditionLevel' => new RawObject('{parent: 0, level: 0, operator: ALL}'),
            'valueData' => array_map(static fn (mixed $filter): RawObject => new RawObject((string) $filter), $filters),
        ])->setSelectionSet(['id']);
    }

    public static function query(int $travelId, array $selectFields): Query
    {
        return (new Mutation('createQuery'))->setArguments([
            'fieldsGoods' => array_map(static fn (string $field): RawObject => new RawObject($field), $selectFields),
            'smartFolder' => $travelId,
            'levelSelection' => new RawObject('ELEMENT'),
            'conditionsType' => new RawObject('ALL'),
            'entity' => new RawObject('GOODS'),
        ])->setSelectionSet(['id']);
    }

    public static function smartFolder(string $title): Query
    {
        return (new Mutation('createSmartTravel'))->setArguments([
            'title' => $title,
            'entity' => new RawObject('GOODS'),
            'status' => new RawObject('ACTIVE'),
            'assignedFor' => new RawObject('MP_TRAVEL'),
            'updatable' => false,
        ])->setSelectionSet(['id']);
    }

    public static function textCondition(int $queryId, string $numberConditions): Query
    {
        return (new Mutation('addCondition'))->setArguments([
            'queryId' => $queryId,
            'conditionLevel' => new RawObject('{parent: 0, level: 0, operator: ALL}'),
            'textConditions' => new RawObject($numberConditions),
        ])->setSelectionSet(['... on TextCondition { id }']);
    }
}
