<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Type;

use GraphQL\Language\AST\Node;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Type\SingletonScalarType;

final class FilterType extends SingletonScalarType
{
    protected static string $type = 'Filter';

    public function __construct()
    {
        parent::__construct([
            'description' => 'Fields:
             
- key: string 
- value: string',
        ]);
    }

    public function serialize($value): mixed
    {
        return $this->parseValue($value);
    }

    public function parseValue($value): mixed
    {
        if (!is_array($value)) {
            return [];
        }

        return [
            'key' => $value['key'],
            'value' => $value['value'],
        ];
    }

    public function parseLiteral(Node $valueNode, ?array $variables = null): array
    {
        return $valueNode->toArray(true);
    }
}
