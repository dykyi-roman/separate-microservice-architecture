<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Type;

use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Type\SingletonObjectType;

/**
 * @psalm-immutable
 */
final class ReadTravelCostType extends SingletonObjectType
{
    protected static string $type = 'ReadTravelCost';

    public function __construct()
    {
        parent::__construct([
            'name' => self::$type,
            'fields' => static function () {
                return [
                    'id' => Type::id(),
                    'tariffId' => Type::id(),
                    'name' => Type::string(),
                    'limit' => Type::float(),
                    'price' => Type::float(),
                    'smartFolderId' => Type::id(),
                    'locationZoneId' => Type::string(),
                    'locationZoneTitle' => Type::string(),
                    'status' => Type::int(),
                    'createdBy' => Type::string(),
                    'updatedBy' => Type::string(),
                    'createdAt' => Type::string(),
                    'updatedAt' => Type::string(),
                ];
            },
        ]);
    }
}
