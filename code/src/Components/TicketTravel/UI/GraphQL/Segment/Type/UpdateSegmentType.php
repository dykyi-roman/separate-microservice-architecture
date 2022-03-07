<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * @psalm-immutable
 */
final class UpdateSegmentType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => substr(__CLASS__, strrpos(__CLASS__, '\\') + 1),
            'description' => 'Update segment type',
            'fields' => static function () {
                return [
                    'title' => Type::string(),
                    'conditionIds' => Type::listOf(Type::id()),
                ];
            },
        ]);
    }
}
