<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\Seller;

enum ErrorCode: int
{
    case SELLER_NOT_FOUND_BY_ID = 20201;
    case SELLER_NOT_FOUND_BY_TITLE = 20202;
    case SELLER_TITLE_IS_EMPTY = 20203;
}
