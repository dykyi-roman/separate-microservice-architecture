<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Query;

use Closure;
use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Application\Travel\Travel\Read\ArgumentResolver;
use Travel\Components\TicketTravel\Application\Travel\Travel\Read\Resolver;
use Travel\Components\TicketTravel\Application\Travel\Travel\Read\Responder;
use Travel\Components\TicketTravel\UI\GraphQL\Travel\Type\ReadTravelType;

final class ReadTravelQuery
{
    public function __construct(private Resolver $resolver, private Responder $responder)
    {
    }

    public function __invoke(array $documentation): array
    {
        return [
            'description' => $documentation['description'],
            'type' => ReadTravelType::instance(),
            'args' => [
                'id' => Type::nonNull(Type::id()),
            ],
            'resolve' => Closure::fromCallable([$this, 'resolve']),
        ];
    }

    private function resolve(mixed $root, array $args): array
    {
        return ($this->responder)(($this->resolver)(new ArgumentResolver($args)));
    }
}
