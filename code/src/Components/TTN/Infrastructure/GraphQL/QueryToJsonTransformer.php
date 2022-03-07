<?php

declare(strict_types=1);

namespace Travel\Components\TTN\Infrastructure\GraphQL;

use GraphQL\Query;
use Stringable;

final class QueryToJsonTransformer implements Stringable
{
    public function __construct(private Query $query)
    {
    }

    public function __toString(): string
    {
        return sprintf('{"query":"%s"}', str_replace(["\n", '"'], ['', '\"'], trim((string) $this->query)));
    }
}
