<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation;

use GraphQL\Mutation;
use GraphQL\Query;
use GraphQL\RawObject;

/**
 * @psalm-immutable
 */
final class DeleteMutation
{
    public static function condition(int $queryId, int $conditionId, string $conditionType): Query
    {
        return (new Mutation('deleteCondition'))->setArguments([
            'queryId' => $queryId,
            'conditionId' => $conditionId,
            'conditionType' => new RawObject($conditionType),
        ])->setSelectionSet(['id']);
    }

    public static function filter(int $queryId, int $filterId): Query
    {
        return (new Mutation('deleteFilter'))->setArguments([
            'queryId' => $queryId,
            'filterId' => $filterId,
        ])->setSelectionSet(['id']);
    }

    public static function smartFolder(int $travelId): Query
    {
        return (new Mutation('deleteSmartTravel'))->setArguments([
            'id' => $travelId,
        ])->setSelectionSet(['id']);
    }
}
