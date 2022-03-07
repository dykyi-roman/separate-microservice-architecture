<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\Gapi;

use Travel\Components\TicketTravel\Features\Segment\Category\CategoryDto;
use Travel\Components\TicketTravel\Features\Segment\Category\CategoryGatewayInterface;
use Travel\Infrastructure\Http\Exception\ResponseException;
use Travel\Infrastructure\Http\ResponseExtractor\ResponseDataExtractorInterface;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use RuntimeException;
use Throwable;

final class GapiGateway implements CategoryGatewayInterface
{
    public function __construct(private GapiClient $client, private ResponseDataExtractorInterface $dataExtractor)
    {
    }

    public function categoryById(int $categoryId): CategoryDto
    {
        try {
            $response = $this->client->get('/categories/list', ['category_ids' => $categoryId]);
            $payload = $this->dataExtractor->extract($response);
        } catch (ClientExceptionInterface $exception) {
            throw ResponseException::badRequest($exception->getMessage());
        } catch (JsonException $exception) {
            throw ResponseException::hasNotValidJson($exception->getMessage());
        } catch (Throwable $exception) {
            throw ResponseException::unknownError($exception->getMessage());
        }

        ResponseAssert::hasErrors($payload);
        ResponseAssert::absentKey($payload, 'categories');

        if (empty($payload['categories'])) {
            throw new RuntimeException(sprintf('Category by ID "%d" not found', $categoryId));
        }

        return new CategoryDto((int) $payload['categories'][0]['id'], $payload['categories'][0]['title']);
    }

    /**
     * @return CategoryDto[]
     */
    public function categoriesByTitle(string $title): array
    {
        try {
            $response = $this->client->get('/categories/list', ['title' => $title]);
            $payload = $this->dataExtractor->extract($response);
        } catch (ClientExceptionInterface $exception) {
            throw ResponseException::badRequest($exception->getMessage());
        } catch (JsonException $exception) {
            throw ResponseException::hasNotValidJson($exception->getMessage());
        } catch (Throwable $exception) {
            throw ResponseException::unknownError($exception->getMessage());
        }

        ResponseAssert::hasErrors($payload);
        ResponseAssert::absentKey($payload, 'categories');
        ResponseAssert::emptyKey($payload, 'categories');

        $categories = [];
        foreach ($payload['categories'] as $index => $category) {
            $categories[] = new CategoryDto(
                (int) $payload['categories'][$index]['id'],
                $payload['categories'][$index]['title']
            );
        }

        return $categories;
    }
}
