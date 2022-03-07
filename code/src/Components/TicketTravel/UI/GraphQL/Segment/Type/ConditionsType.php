<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * @psalm-immutable
 */
final class ConditionsType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => substr(__CLASS__, strrpos(__CLASS__, '\\') + 1),
            'description' => 'ConditionsType',
            'fields' => static function () {
                return [
                    'id' => Type::id(),
                    'type' => Type::string(),
                    'value' => Type::string(),
                ];
            },
        ]);
    }
}
