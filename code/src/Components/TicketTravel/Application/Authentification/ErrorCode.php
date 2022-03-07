<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Authentification;

enum ErrorCode: int
{
    case TOKEN_IS_INVALID = 1101;
    case TOKEN_IS_EXPIRED = 1102;
    case TOKEN_IS_MISSING = 1103;
}
