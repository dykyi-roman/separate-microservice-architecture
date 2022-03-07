<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\Category;

/**
 * @psalm-immutable
 */
final class CategoryDto
{
    public function __construct(public readonly int $id, public readonly string $title)
    {
    }
}
