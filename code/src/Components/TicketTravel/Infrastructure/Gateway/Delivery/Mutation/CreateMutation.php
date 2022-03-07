<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\Mutation;

use GraphQL\Mutation;
use GraphQL\Query;

/**
 * @psalm-immutable
 */
final class CreateMutation
{
    public static function createTravel(
        string $name,
        string $serviceId,
        string $methodId,
        string $strategy,
        int $status
    ): Query {
        return (new Mutation('travelTravel'))->setArguments([
            'name' => $name,
            'serviceId' => $serviceId,
            'methodMapId' => $methodId,
            'strategy' => $strategy,
            'status' => $status,
        ])->setSelectionSet(['id']);
    }

    public static function createTravelCost(
        int $tariffId,
        string $name,
        float $limit,
        float $price,
        string $locationZoneId,
        int $smartFolderId,
        int $status
    ): Query {
        return (new Mutation('travelTravelCost'))->setArguments([
            'tariff' => $tariffId,
            'name' => $name,
            'limit' => $limit,
            'price' => $price,
            'goodsSegmentId' => $smartFolderId,
            'zoneMapId' => $locationZoneId,
            'status' => $status,
        ])->setSelectionSet(['id']);
    }
}
