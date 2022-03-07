<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\Category;

use Psr\Log\LoggerInterface;
use Throwable;

final class FindCategory
{
    public function __construct(private CategoryGatewayInterface $categoryGateway, private LoggerInterface $logger)
    {
    }

    /**
     * @throws FindCategoryException
     */
    public function findCategoryById(int $categoryId): CategoryDto
    {
        try {
            return $this->categoryGateway->categoryById($categoryId);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw FindCategoryException::notFindCategoryById($categoryId);
        }
    }

    /**
     * @throws FindCategoryException
     */
    public function findCategoriesByText(string $categoryTitle): array
    {
        if (empty($categoryTitle)) {
            throw FindCategoryException::titleIsEmpty();
        }

        try {
            return $this->categoryGateway->categoriesByTitle($categoryTitle);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw FindCategoryException::notFindCategoryByTitle($categoryTitle);
        }
    }
}
