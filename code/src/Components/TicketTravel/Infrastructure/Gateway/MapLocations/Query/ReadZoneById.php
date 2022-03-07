<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\MapLocations\Query;

use GraphQL\Query;

final class ReadZoneById
{
    public static function zone(string $id): Query
    {
        return (new Query('zone'))
            ->setArguments(['id' => $id])
            ->setSelectionSet(['id status { nameUa } nameUa']);
    }
}
