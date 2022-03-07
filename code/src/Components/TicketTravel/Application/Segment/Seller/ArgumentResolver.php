<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\Seller;

use Travel\Components\TicketTravel\Application\Segment\ValidationAssert;

final class ArgumentResolver
{
    private const MIN_LENGTH_SIZE = 2;
    private const MAX_LENGTH_SIZE = 200;

    public readonly string $value;

    public function __construct(array $arguments)
    {
        ValidationAssert::keyExists($arguments, 'value', ErrorCode::VALUE_NOT_DEFINED->value);
        ValidationAssert::keyIsString($arguments, 'value', ErrorCode::VALUE_TYPE_IS_WRONG->value);

        $this->value = is_numeric($arguments['value']) ?
            $this->numericValue((string) $arguments['value']) :
            $this->stringValue($arguments['value']);
    }

    private function numericValue(string $value): string
    {
        ValidationAssert::greaterThan((int) $value, 0, ErrorCode::ID_NOT_VALID->value);

        return $value;
    }

    private function stringValue(string $value): string
    {
        $length = mb_strlen($value);
        ValidationAssert::lessThan($length, self::MAX_LENGTH_SIZE, ErrorCode::TEXT_MAX_LENGTH->value);
        ValidationAssert::greaterThan($length, self::MIN_LENGTH_SIZE, ErrorCode::TEXT_MIN_LENGTH->value);
        ValidationAssert::specSymbolExist($value[0]);

        return trim($value, ' ');
    }
}
