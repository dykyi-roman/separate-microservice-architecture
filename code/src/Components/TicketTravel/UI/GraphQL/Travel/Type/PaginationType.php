<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\UI\GraphQL\Travel\Type;

use GraphQL\Type\Definition\Type;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Type\SingletonObjectType;

/**
 * @psalm-immutable
 */
final class PaginationType extends SingletonObjectType
{
    protected static string $type = 'Pagination';

    public function __construct()
    {
        parent::__construct([
            'name' => self::$type,
            'fields' => static function () {
                return [
                    'totalCount' => Type::int(),
                    'pageCount' => Type::int(),
                    'itemsPerPage' => Type::int(),
                    'currentPage' => Type::int(),
                ];
            },
        ]);
    }
}
