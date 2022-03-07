<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Travel\Travel;

use JsonSerializable;

final class PaginationDto implements JsonSerializable
{
    public function __construct(
        public readonly int $totalCount,
        public readonly int $pageCount,
        public readonly int $itemsPerPage,
        public readonly int $currentPage,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            (int) $data['totalCount'],
            (int) $data['pageCount'],
            (int) $data['itemsPerPage'],
            (int) $data['currentPage'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'totalCount' => $this->totalCount,
            'pageCount' => $this->pageCount,
            'itemsPerPage' => $this->itemsPerPage,
            'currentPage' => $this->currentPage,
        ];
    }
}
