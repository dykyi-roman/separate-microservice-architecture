<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Create;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\Condition;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\ErrorCode;
use Travel\Components\TicketTravel\Application\Segment\ValidationAssert;

final class ArgumentResolver
{
    private const MIN_LENGTH_SIZE = 1;
    private const MAX_LENGTH_SIZE = 200;

    public readonly string $title;
    public readonly array $conditions;

    public function __construct(array $arguments)
    {
        ValidationAssert::keyExists($arguments, 'title', ErrorCode::TRAVEL_TITLE_NOT_DEFINED->value);
        $length = mb_strlen($arguments['title']);
        ValidationAssert::lessThan($length, self::MAX_LENGTH_SIZE, ErrorCode::TRAVEL_TITLE_MAX_LENGTH->value);
        ValidationAssert::greaterThan($length, self::MIN_LENGTH_SIZE, ErrorCode::TRAVEL_TITLE_MIN_LENGTH->value);

        ValidationAssert::keyExists($arguments, 'conditions', ErrorCode::CONDITIONS_NOT_DEFINED->value);
        ValidationAssert::keyIsArray($arguments, 'conditions', ErrorCode::CONDITIONS_NOT_ARRAY->value);
        ValidationAssert::arrayNotEmpty($arguments, 'conditions', ErrorCode::CONDITIONS_IS_EMPTY->value);

        array_map(static fn (Condition $condition) => $condition->validate(), $arguments['conditions']);

        $this->title = trim((string) $arguments['title'], ' ');
        $this->conditions = $arguments['conditions'];
    }
}
