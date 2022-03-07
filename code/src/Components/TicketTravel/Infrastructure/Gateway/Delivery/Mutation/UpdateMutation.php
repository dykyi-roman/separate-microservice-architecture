<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\Mutation;

use GraphQL\Mutation;
use GraphQL\Query;

/**
 * @psalm-immutable
 */
final class UpdateMutation
{
    public static function updateTravel(
        int $id,
        string $name,
        string $serviceId,
        string $methodId,
        int $status
    ): Query {
        return (new Mutation('travelTravel'))->setArguments([
            'id' => $id,
            'name' => $name,
            'serviceId' => $serviceId,
            'methodMapId' => $methodId,
            'status' => $status,
        ])->setSelectionSet(['id']);
    }

    public static function updateTravelCost(
        int $id,
        string $name,
        float $limit,
        float $price,
        string $locationZoneId,
        int $smartFolderId,
        int $status
    ): Query {
        return (new Mutation('travelTravelCost'))->setArguments([
            'id' => $id,
            'name' => $name,
            'limit' => $limit,
            'price' => $price,
            'goodsSegmentId' => $smartFolderId,
            'zoneMapId' => $locationZoneId,
            'status' => $status,
        ])->setSelectionSet(['id']);
    }
}
