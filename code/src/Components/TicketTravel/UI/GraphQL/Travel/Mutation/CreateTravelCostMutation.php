<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Mutation;

use Closure;
use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Application\Travel\TravelCost\Create\ArgumentResolver;
use Travel\Components\TicketTravel\Application\Travel\TravelCost\Create\Resolver;
use Travel\Components\TicketTravel\Application\Travel\TravelCost\Create\Responder;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Type\TravelCostType;

final class CreateTravelCostMutation
{
    public function __construct(private Resolver $resolver, private Responder $responder)
    {
    }

    public function __invoke(array $documentation): array
    {
        return [
            'description' => $documentation['description'],
            'type' => TravelCostType::instance(),
            'args' => [
                'tariffId' => Type::nonNull(Type::id()),
                'smartFolderId' => Type::nonNull(Type::id()),
                'locationZoneId' => Type::nonNull(Type::string()),
                'name' => Type::nonNull(Type::string()),
                'limit' => Type::nonNull(Type::float()),
                'price' => Type::nonNull(Type::float()),
                'status' => Type::nonNull(Type::int()),
            ],
            'resolve' => Closure::fromCallable([$this, 'resolve']),
        ];
    }

    private function resolve(mixed $root, array $args): array
    {
        return ($this->responder)(($this->resolver)(new ArgumentResolver($args)));
    }
}
