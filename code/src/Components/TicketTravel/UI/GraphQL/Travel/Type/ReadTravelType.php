<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Type;

use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Type\SingletonObjectType;

/**
 * @psalm-immutable
 */
final class ReadTravelType extends SingletonObjectType
{
    protected static string $type = 'ReadTravel';

    public function __construct()
    {
        parent::__construct([
            'name' => self::$type,
            'fields' => static function () {
                return [
                    'id' => Type::id(),
                    'name' => Type::string(),
                    'service' => NamedIdType::instance(),
                    'method' => NamedIdType::instance(),
                    'strategy' => NamedIdType::instance(),
                    'status' => NamedIdType::instance(),
                    'createdBy' => Type::string(),
                    'updatedBy' => Type::string(),
                    'createdAt' => Type::string(),
                    'updatedAt' => Type::string(),
                ];
            },
        ]);
    }
}
