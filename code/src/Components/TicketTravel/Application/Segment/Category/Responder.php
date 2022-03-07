<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\Category;

use Travel\Components\TicketTravel\Features\Segment\Category\CategoryDto;

/**
 * @psalm-immutable
 */
final class Responder
{
    public function __invoke(array $categories): array
    {
        return array_map(static fn (CategoryDto $category): array => [
            'id' => $category->id,
            'title' => $category->title,
        ], $categories);
    }
}
