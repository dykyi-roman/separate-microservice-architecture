<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Travel\LocationZone;

use Travel\Components\TicketTravel\Application\Travel\ValidationAssert;
use Symfony\Component\Uid\Uuid;

final class ArgumentResolver
{
    private const MIN_LENGTH_SIZE = 2;
    private const MAX_LENGTH_SIZE = 200;

    public readonly string|Uuid $value;

    public function __construct(array $arguments)
    {
        ValidationAssert::keyExists($arguments, 'value', ErrorCode::VALUE_NOT_DEFINED->value);
        ValidationAssert::keyIsString($arguments, 'value', ErrorCode::VALUE_TYPE_IS_WRONG->value);

        $this->value = Uuid::isValid($arguments['value']) ?
            $this->uuidValue($arguments['value']) :
            $this->stringValue($arguments['value']
        );
    }

    private function uuidValue(string $value): Uuid
    {
        return Uuid::fromString(trim($value, ' '));
    }

    private function stringValue(string $value): string
    {
        $length = mb_strlen($value);
        ValidationAssert::lessThan($length, self::MAX_LENGTH_SIZE, ErrorCode::TEXT_MAX_LENGTH->value);
        ValidationAssert::greaterThan($length, self::MIN_LENGTH_SIZE, ErrorCode::TEXT_MIN_LENGTH->value);

        return trim($value, ' ');
    }
}
