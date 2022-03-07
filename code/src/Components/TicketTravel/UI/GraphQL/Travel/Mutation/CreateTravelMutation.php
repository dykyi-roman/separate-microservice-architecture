<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Mutation;

use Closure;
use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Application\Travel\Travel\Create\ArgumentResolver;
use Travel\Components\TicketTravel\Application\Travel\Travel\Create\Resolver;
use Travel\Components\TicketTravel\Application\Travel\Travel\Create\Responder;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Type\TravelType;

final class CreateTravelMutation
{
    public function __construct(private Resolver $resolver, private Responder $responder)
    {
    }

    public function __invoke(array $documentation): array
    {
        return [
            'description' => $documentation['description'],
            'type' => TravelType::instance(),
            'args' => [
                'name' => Type::nonNull(Type::string()),
                'serviceId' => Type::nonNull(Type::string()),
                'methodId' => Type::nonNull(Type::string()),
                'strategy' => Type::nonNull(Type::string()),
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
