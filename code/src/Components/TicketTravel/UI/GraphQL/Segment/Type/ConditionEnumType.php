<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Type;

use GraphQL\Type\Definition\EnumType;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Type;

/**
 * @psalm-immutable
 */
final class ConditionEnumType extends EnumType
{
    public function __construct()
    {
        $conditions = array_map(static fn (Type $type): string => $type->value, Type::cases());

        parent::__construct([
            'name' => substr(__CLASS__, strrpos(__CLASS__, '\\') + 1),
            'description' => 'Condition types',
            'values' => [...$conditions],
        ]);
    }
}
