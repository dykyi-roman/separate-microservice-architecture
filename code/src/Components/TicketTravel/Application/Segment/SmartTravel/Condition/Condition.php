<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\SmartTravel\Condition;

use Travel\Components\TicketTravel\Application\Segment\SmartTravel\ErrorCode;
use Travel\Components\TicketTravel\Application\Segment\SmartTravel\Type;
use Travel\Components\TicketTravel\Application\Segment\ValidationAssert;

/**
 * @psalm-immutable
 */
final class Condition
{
    public function __construct(
        public readonly int|null $id,
        public readonly string $value,
        public readonly null|Type $type
    ) {
    }

    public function isNew(): bool
    {
        return null === $this->id;
    }

    /**
     * @psalm-suppress ImpureMethodCall
     */
    public function validate(): void
    {
        ValidationAssert::isId($this->value, ErrorCode::CONDITION_VALUE_NOT_VALID->value);
        if (!$this->isNew()) {
            ValidationAssert::isId((string) $this->id, ErrorCode::CONDITION_VALUE_NOT_VALID->value);
        }
    }

    public static function fromArrayToCondition(array $condition): self
    {
        $value = $condition['value'];
        $type = Type::tryFrom($condition['type']);
        if (null === $type) {
            Type::typeNotSupportedException();
        }

        return new self(array_key_exists('id', $condition) ? (int) $condition['id'] : null, $value, $type);
    }

    public static function fromConditionToArray(self $condition): array
    {
        $type = $condition->type;

        return [
            'id' => $condition->id,
            'value' => $condition->value,
            'type' => $type?->value,
        ];
    }
}
