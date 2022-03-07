<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Query;

use Closure;
use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Application\Travel\Travel\List\ArgumentResolver;
use Travel\Components\TicketTravel\Application\Travel\Travel\List\Resolver;
use Travel\Components\TicketTravel\Application\Travel\Travel\List\Responder;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Type\FilterType;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Type\ListTravelType;

final class ListOfTravelsQuery
{
    public function __construct(private Resolver $resolver, private Responder $responder)
    {
    }

    public function __invoke(array $documentation): array
    {
        return [
            'description' => $documentation['description'],
            'type' => new ListTravelType(),
            'args' => [
                'page' => Type::nonNull(Type::int()),
                'itemsPerPage' => Type::nonNull(Type::int()),
                'filters' => [
                    'type' => Type::listOf(FilterType::instance()),
                    'description' => $documentation['arguments']['filters'],
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
