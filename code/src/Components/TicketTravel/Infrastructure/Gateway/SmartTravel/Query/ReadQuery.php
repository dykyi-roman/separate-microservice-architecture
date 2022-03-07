<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Query;

use GraphQL\Query;

/**
 * @psalm-immutable
 */
final class ReadQuery
{
    public static function smartFolder(int $travelId): Query
    {
        return (new Query('smartFolder'))->setArguments(['id' => $travelId])->setSelectionSet([
            sprintf(
                'id, title, queryEntity { id %s %s %s }',
                self::textConditions(),
                self::numberConditions(),
                self::filterConditions(),
            ),
        ]);
    }

    private static function numberConditions(): string
    {
        return 'numberConditions { id field values }';
    }

    private static function textConditions(): string
    {
        return 'textConditions { id field value }';
    }

    private static function filterConditions(): string
    {
        return 'filterConditions {
              filterEntities {
                ... on FilterEntityGoods { id, valueData { value valueTitle } }
            }
        }';
    }
}
