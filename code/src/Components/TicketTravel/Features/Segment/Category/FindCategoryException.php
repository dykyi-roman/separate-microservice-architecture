<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\Category;

use RuntimeException;

final class FindCategoryException extends RuntimeException
{
    public static function notFindCategoryById(int $id): self
    {
        return new self(
            sprintf('Could not find category by value "%d".', $id),
            ErrorCode::CATEGORY_NOT_FOUND_BY_ID->value
        );
    }

    public static function notFindCategoryBytitle(string $title): self
    {
        return new self(
            sprintf('Could not find category by title "%s".', $title),
            ErrorCode::CATEGORY_NOT_FOUND_BY_TITLE->value
        );
    }

    public static function titleIsEmpty(): self
    {
        return new self('Category title is empty', ErrorCode::CATEGORY_TITLE_IS_EMPTY->value);
    }
}
