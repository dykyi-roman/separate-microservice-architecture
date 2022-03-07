<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

final class SellerType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => substr(__CLASS__, strrpos(__CLASS__, '\\') + 1),
            'fields' => static function () {
                return [
                    'owoxid' => Type::id(),
                    'travelId' => Type::id(),
                    'title' => Type::string(),
                ];
            },
        ]);
    }
}
