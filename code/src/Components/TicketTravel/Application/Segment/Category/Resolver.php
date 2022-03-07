<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Application\Segment\Category;

use Travel\Components\TicketTravel\Features\Segment\Category\FindCategory;
use Travel\Components\TicketTravel\Features\Segment\Category\FindCategoryException;

final class Resolver
{
    public function __construct(private FindCategory $findCategory)
    {
    }

    public function __invoke(ArgumentResolver $arguments): array
    {
        try {
            if (is_numeric($arguments->value)) {
                return [$this->findCategory->findCategoryById((int) $arguments->value)];
            }

            return $this->findCategory->findCategoriesByText($arguments->value);
        } catch (FindCategoryException) {
            return [];
        }
    }
}
