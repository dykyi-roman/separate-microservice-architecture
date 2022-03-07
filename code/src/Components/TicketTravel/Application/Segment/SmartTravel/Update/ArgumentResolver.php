<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Update;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition\Condition;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\ErrorCode;
use Travel\Components\TicketTravel\Application\Segment\ValidationAssert;

final class ArgumentResolver
{
    private const MIN_LENGTH_SIZE = 1;
    private const MAX_LENGTH_SIZE = 200;

    public readonly int $travelId;
    public readonly int $queryId;
    public readonly string|null $title;
    /** @var Condition[] */
    public readonly array $conditions;

    public function __construct(array $arguments)
    {
        ValidationAssert::keyExists($arguments, 'smartFolderId', ErrorCode::TRAVEL_ID_NOT_DEFINED->value);
        ValidationAssert::keyExists($arguments, 'queryId', ErrorCode::QUERY_ID_NOT_DEFINED->value);
        array_map(static fn (Condition $condition) => $condition->validate(), $arguments['conditions']);

        if (array_key_exists('title', $arguments)) {
            $length = mb_strlen($arguments['title']);
            ValidationAssert::lessThan($length, self::MAX_LENGTH_SIZE, ErrorCode::TRAVEL_TITLE_MAX_LENGTH->value);
            ValidationAssert::greaterThan($length, self::MIN_LENGTH_SIZE, ErrorCode::TRAVEL_TITLE_MIN_LENGTH->value);
        }

        $this->travelId = (int) $arguments['smartFolderId'];
        $this->queryId = (int) $arguments['queryId'];
        $this->title = array_key_exists('title', $arguments) ? trim((string) $arguments['title'], ' ') : null;
        $this->conditions = array_key_exists('conditions', $arguments) ? (array) $arguments['conditions'] : [];
    }
}
