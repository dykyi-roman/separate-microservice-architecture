<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\Category;

interface CategoryGatewayInterface
{
    /**
     * @throws \RuntimeException
     */
    public function categoryById(int $categoryId): CategoryDto;

    /**
     * @throws \RuntimeException
     *
     * @return CategoryDto[]
     */
    public function categoriesByTitle(string $title): array;
}
