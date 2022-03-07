<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * @psalm-immutable
 */
final class CreateSegmentType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => substr(__CLASS__, strrpos(__CLASS__, '\\') + 1),
            'description' => 'Create Segment type',
            'fields' => static function () {
                return [
                    'smartFolderId' => Type::id(),
                    'queryId' => Type::id(),
                    'conditionIds' => Type::listOf(Type::id()),
                ];
            },
        ]);
    }
}
