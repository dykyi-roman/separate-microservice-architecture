<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Documentation;

use Stringable;
use UnitEnum;

/**
 * @psalm-immutable
 * @psalm-suppress NoInterfaceProperties
 */
final class ErrorToStringTransformer implements Stringable
{
    private string $text;

    public function __construct(UnitEnum ...$unitEnum)
    {
        $this->text = '';

        foreach ($unitEnum as $case) {
            /* @phpstan-ignore-next-line */
            $this->text .= sprintf('- `%d` - %s%s', $case->value, $case->name, PHP_EOL);
        }
    }

    public function __toString(): string
    {
        return $this->text;
    }
}
