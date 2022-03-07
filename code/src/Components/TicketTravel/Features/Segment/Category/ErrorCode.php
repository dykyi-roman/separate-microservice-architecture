<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\Category;

enum ErrorCode: int
{
    case CATEGORY_NOT_FOUND_BY_ID = 20101;
    case CATEGORY_NOT_FOUND_BY_TITLE = 20102;
    case CATEGORY_TITLE_IS_EMPTY = 20103;
}
