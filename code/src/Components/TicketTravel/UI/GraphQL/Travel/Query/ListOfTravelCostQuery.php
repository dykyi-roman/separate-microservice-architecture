<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Query;

use Closure;
use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Application\Travel\TravelCost\Read\ArgumentResolver;
use Travel\Components\TicketTravel\Application\Travel\TravelCost\Read\Resolver;
use Travel\Components\TicketTravel\Application\Travel\TravelCost\Read\Responder;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Type\ReadTravelCostType;

final class ListOfTravelCostQuery
{
    public function __construct(private Resolver $resolver, private Responder $responder)
    {
    }

    public function __invoke(array $documentation): array
    {
        return [
            'description' => $documentation['description'],
            'type' => Type::listOf(ReadTravelCostType::instance()),
            'args' => [
                'tariffId' => Type::nonNull(Type::id()),
            ],
            'resolve' => Closure::fromCallable([$this, 'resolve']),
        ];
    }

    private function resolve(mixed $root, array $args): array
    {
        return ($this->responder)(($this->resolver)(new ArgumentResolver($args)));
    }
}
