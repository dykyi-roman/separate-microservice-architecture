<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Segment\Query;

use Closure;
use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Read\ArgumentResolver;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Read\Resolver;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Read\Responder;
use Travel\Components\TicketTravel\UI\GraphQL\Segment\Type\ReadSegmentType;

final class ReadSegmentQuery
{
    public function __construct(private Resolver $resolver, private Responder $responder)
    {
    }

    public function __invoke(array $documentation): array
    {
        return [
            'description' => $documentation['description'],
            'type' => new ReadSegmentType(),
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
