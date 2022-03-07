<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition;

use Travel\Components\TicketTravel\Features\Segment\SmartTravel\ErrorCode;
use RuntimeException;

final class ConditionException extends RuntimeException
{
    public static function failedToAddCondition(ErrorCode $code): self
    {
        return new self('Failed to add condition.', $code->value);
    }

    public static function failedToDeleteFilter(ErrorCode $code): self
    {
        return new self('Failed to delete filter.', $code->value);
    }

    public static function failedToDeleteCondition(ErrorCode $code): self
    {
        return new self('Failed to delete condition.', $code->value);
    }
}
