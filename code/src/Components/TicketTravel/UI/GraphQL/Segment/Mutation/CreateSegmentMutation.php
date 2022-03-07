<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Mutation;

use Closure;
use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Create\ArgumentResolver;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Create\Resolver;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Create\Responder;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Type\ConditionType;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Type\CreateSegmentType;

final class CreateSegmentMutation
{
    public function __construct(private Resolver $resolver, private Responder $responder)
    {
    }

    public function __invoke(array $documentation): array
    {
        return [
            'description' => $documentation['description'],
            'type' => new CreateSegmentType(),
            'args' => [
                'title' => Type::nonNull(Type::string()),
                'conditions' => [
                    'type' => Type::nonNull(Type::listOf(ConditionType::instance())),
                    'description' => $documentation['arguments']['conditions'],
                ],
            ],
            'resolve' => Closure::fromCallable([$this, 'resolve']),
        ];
    }

    private function resolve(mixed $root, array $args): array
    {
        return ($this->responder)(($this->resolver)(new ArgumentResolver($args)));
    }
}
