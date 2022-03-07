<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Mutation;

use Closure;
use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Application\Travel\TravelCost\Update\ArgumentResolver;
use Travel\Components\TicketTravel\Application\Travel\TravelCost\Update\Resolver;
use Travel\Components\TicketTravel\Application\Travel\TravelCost\Update\Responder;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Type\TravelCostType;

final class UpdateTravelCostMutation
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
                'id' => Type::nonNull(Type::Id()),
                'smartFolderId' => Type::id(),
                'locationZoneId' => Type::string(),
                'name' => Type::string(),
                'limit' => Type::float(),
                'price' => Type::float(),
                'status' => Type::int(),
            ],
            'resolve' => Closure::fromCallable([$this, 'resolve']),
        ];
    }

    private function resolve(mixed $root, array $args): array
    {
        return ($this->responder)(($this->resolver)(new ArgumentResolver($args)));
    }
}
