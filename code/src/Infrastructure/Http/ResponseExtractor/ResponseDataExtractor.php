<?php

declare(strict_types=1);

namespace Travel\Infrastructure\Http\ResponseExtractor;

use JsonException;
use Psr\Http\Message\ResponseInterface;

final class ResponseDataExtractor implements ResponseDataExtractorInterface
{
    /**
     * @throws JsonException
     */
    public function extract(ResponseInterface $response): array
    {
        return (array) json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}
