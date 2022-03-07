<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\Travel;

enum ErrorCode: int
{
    case FAILED_TO_CREATE_TRAVEL = 20501;
    case TRAVEL_ALREADY_EXISTS = 20502;
    case FAILED_TO_UPDATE_TRAVEL = 20503;
    case FAILED_TO_READ_TRAVEL = 20504;
    case FAILED_TO_READ_TRAVEL_LIST = 20505;
    case UNABLE_TO_ACTIVATE_TRAVEL = 20506;
}
