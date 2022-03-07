<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel;

use InvalidArgumentException;

enum Type: string
{
    case ORDER = 'ORDER';
    case SELLER = 'SELLER';
    case CATEGORY = 'CATEGORY';
    public static function typeNotSupportedException(): InvalidArgumentException
    {
        $cases = array_map(static fn (Type $enum): string => $enum->value, Type::cases());

        return new InvalidArgumentException(
            sprintf('Available values: [%s]', implode(', ', $cases)),
            ErrorCode::CONDITION_TYPE_NOT_VALID->value
        );
    }
}
