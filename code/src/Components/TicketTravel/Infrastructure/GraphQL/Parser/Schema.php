<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Parser;

final class Schema
{
    public readonly string $method;
    public readonly array $variables;

    public function __construct(string $query)
    {
        $content = trim((string) preg_replace('/\s\s+/', ' ', $query));
        $content = (array) json_decode($content, true);

        $query = explode(' ', (string) $content['query']);
        $query = explode('(', $query[1]);

        $this->method = $query[0];
        $this->variables = (array) $content['variables'];
    }
}
