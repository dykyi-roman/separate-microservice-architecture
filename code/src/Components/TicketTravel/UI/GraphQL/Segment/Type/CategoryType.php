<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * @psalm-immutable
 */
final class CategoryType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => substr(__CLASS__, strrpos(__CLASS__, '\\') + 1),
            'fields' => static function () {
                return [
                    'id' => Type::id(),
                    'title' => Type::string(),
                ];
            },
        ]);
    }
}
