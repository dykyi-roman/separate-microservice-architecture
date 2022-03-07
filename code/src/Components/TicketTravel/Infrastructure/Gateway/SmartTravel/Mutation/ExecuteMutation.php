<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation;

use GraphQL\Mutation;
use GraphQL\Query;

/**
 * @psalm-immutable
 */
final class ExecuteMutation
{
    public static function filters(int $queryId): Query
    {
        return (new Mutation('filtersExecute'))->setArguments(['queryId' => $queryId])->setSelectionSet(['id']);
    }
}
