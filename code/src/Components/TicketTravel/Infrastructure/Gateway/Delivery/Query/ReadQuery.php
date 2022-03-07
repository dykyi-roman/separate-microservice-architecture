<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\Query;

use GraphQL\Query;
use GraphQL\RawObject;

/**
 * @psalm-immutable
 */
final class ReadQuery
{
    public static function readTravel(int $tariffId): Query
    {
        return (new Query('travelTravel'))
            ->setArguments(['id' => $tariffId])
            ->setSelectionSet(['id name serviceId methodMapId strategy status createdBy updatedBy createdAt updatedAt']);
    }

    public static function readTravelList(int $page, int $itemsPerPage, array $filters): Query
    {
        $filter = empty($filters) ? [] : ['filter' => new RawObject(sprintf('{%s}', self::parseFilters($filters)))];

        return (new Query('travelTravels'))
            ->setArguments(['page' => $page, 'itemsPerPage' => $itemsPerPage] + $filter)
            ->setSelectionSet(['id name serviceId methodMapId strategy status createdBy updatedBy createdAt updatedAt']);
    }

    public static function listOfTravelCosts(int $tariffId): Query
    {
        return (new Query('travelTravelCosts'))
            ->setArguments(['filter' => new RawObject(sprintf('{tariff: {id: {eq: %d}}}', $tariffId))])
            ->setSelectionSet(['id tariff { id } name limit price goodsSegmentId zoneMapId zoneMapTitle status createdBy 
            updatedBy createdAt updatedAt']);
    }

    private static function parseFilters(array $filters): string
    {
        $result = '';
        foreach ($filters as $filter) {
            if ('id' === $filter['key']) {
                $result .= sprintf(' id: {eq: %d}', (int) $filter['value']);
            }

            if ('name' === $filter['key']) {
                $result .= sprintf(' name: {like: "%%%s%%"}', $filter['value']);
            }

            if ('status' === $filter['key']) {
                $result .= sprintf(' status: {eq: %d}', (int) (bool) $filter['value']);
            }

            if ('serviceId' === $filter['key']) {
                $result .= sprintf(' serviceId: {eq: "%s"}', $filter['value']);
            }

            if ('methodId' === $filter['key']) {
                $result .= sprintf(' methodMapId: {eq: "%s"}', $filter['value']);
            }
        }

        return $result;
    }
}
