<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Mutation;

use Closure;
use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\Delete\ArgumentResolver;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\Delete\Resolver;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Type\ConditionEnumType;

final class DeleteConditionMutation
{
    public function __construct(private Resolver $resolver)
    {
    }

    public function __invoke(array $documentation): array
    {
        return [
            'description' => $documentation['description'],
            'type' => Type::boolean(),
            'args' => [
                'queryId' => Type::nonNull(Type::id()),
                'conditionId' => Type::nonNull(Type::id()),
                'type' => Type::nonNull(new ConditionEnumType()),
            ],
            'resolve' => Closure::fromCallable([$this, 'resolve']),
        ];
    }

    private function resolve(mixed $root, array $args): bool
    {
        return ($this->resolver)(new ArgumentResolver($args));
    }
}
