<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\MapLocations\Query;

use GraphQL\Query;
use GraphQL\RawObject;

final class ReadZoneByName
{
    public static function zones(string $name): Query
    {
        return (new Query('zones'))
            ->setArguments(['filter' => new RawObject(sprintf('{name:{like: "%%%s%%"}}', $name))])
            ->setSelectionSet(['id nameUa status { nameUa }']);
    }
}
