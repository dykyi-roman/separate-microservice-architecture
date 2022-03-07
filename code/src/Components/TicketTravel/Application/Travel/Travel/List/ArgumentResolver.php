<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\Travel\List;

use Travel\Components\TicketTravel\Application\Travel\Travel\ErrorCode;
use Travel\Components\TicketTravel\Application\Travel\ValidationAssert;

final class ArgumentResolver
{
    private const MIN_LENGTH_SIZE = 1;
    private const MAX_LENGTH_SIZE = 200;

    public readonly int $page;
    public readonly int $itemsPerPage;
    public readonly array $filters;

    public function __construct(array $arguments)
    {
        $page = (int) $arguments['page'];
        ValidationAssert::greaterThan($page, self::MIN_LENGTH_SIZE, ErrorCode::PAGE_MIN_LENGTH->value);

        $itemsPerPage = (int) $arguments['itemsPerPage'];
        ValidationAssert::lessThan($itemsPerPage, self::MAX_LENGTH_SIZE, ErrorCode::ITEMS_PER_PAGE_MAX_LENGTH->value);
        ValidationAssert::greaterThan($itemsPerPage, self::MIN_LENGTH_SIZE, ErrorCode::ITEMS_PER_PAGE_MIN_LENGTH->value);

        $this->page = $page;
        $this->itemsPerPage = $itemsPerPage;
        $this->filters = $arguments['filters'];
    }
}
