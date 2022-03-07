<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * @psalm-immutable
 */
final class ReadSegmentType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => substr(__CLASS__, strrpos(__CLASS__, '\\') + 1),
            'description' => 'Segment',
            'fields' => static function () {
                return [
                    'queryId' => Type::id(),
                    'title' => Type::string(),
                    'conditions' => [
                        'type' => Type::listOf(new ConditionsType()),
                        'description' => 'Array of Condition. Required fields: Condition(type: TYPE value: ID id: ID)',
                    ],
                ];
            },
        ]);
    }
}
