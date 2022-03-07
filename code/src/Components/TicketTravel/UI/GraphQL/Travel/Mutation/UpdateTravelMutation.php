<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Mutation;

use Closure;
use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Application\Travel\Travel\Update\ArgumentResolver;
use Travel\Components\TicketTravel\Application\Travel\Travel\Update\Resolver;
use Travel\Components\TicketTravel\Application\Travel\Travel\Update\Responder;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Type\TravelType;

final class UpdateTravelMutation
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
                'id' => Type::nonNull(Type::int()),
                'name' => Type::string(),
                'serviceId' => Type::string(),
                'methodId' => Type::string(),
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
