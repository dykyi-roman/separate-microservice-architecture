<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Type;

use GraphQL\Language\AST\Node;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\Condition;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Type\SingletonScalarType;

final class ConditionType extends SingletonScalarType
{
    protected static string $type = 'Condition';

    public function serialize($value): mixed
    {
        return $this->parseValue($value);
    }

    public function parseValue($value): mixed
    {
        return Condition::fromArrayToCondition((array) $value);
    }

    public function parseLiteral(Node $valueNode, ?array $variables = null): array
    {
        return $valueNode->toArray(true);
    }
}
