<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\Seller;

use RuntimeException;

final class FindSellerException extends RuntimeException
{
    public static function couldNotFindSellerById(int $id): self
    {
        return new self(
            sprintf('Could not find seller by id "%d".', $id),
            ErrorCode::SELLER_NOT_FOUND_BY_ID->value
        );
    }

    public static function couldNotFindSellerByTitle(string $title): self
    {
        return new self(
            sprintf('Could not find seller by title "%s".', $title),
            ErrorCode::SELLER_NOT_FOUND_BY_TITLE->value
        );
    }

    public static function titleIsEmpty(): self
    {
        return new self('Seller title is empty', ErrorCode::SELLER_TITLE_IS_EMPTY->value);
    }
}
