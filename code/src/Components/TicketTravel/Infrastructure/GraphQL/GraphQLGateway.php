<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL;

use GraphQL\Query;
use Travel\Infrastructure\Http\Exception\UnauthorizedException;
use Travel\Infrastructure\Http\HttpMethod;
use Travel\Infrastructure\Http\ResponseExtractor\ResponseDataExtractorInterface;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Throwable;

abstract class GraphQLGateway
{
    public function __construct(private ResponseDataExtractorInterface $dataExtractor)
    {
    }

    /**
     * @throws RuntimeException
     */
    protected function mutation(Query $mutation): array
    {
        try {
            $response = $this->dataExtractor->extract($this->post($mutation));
        } catch (ClientExceptionInterface $exception) {
            throw ResponseException::badRequest($exception->getMessage());
        } catch (JsonException $exception) {
            throw ResponseException::hasNotValidJson($exception->getMessage());
        } catch (Throwable $exception) {
            throw ResponseException::unknownError($exception->getMessage());
        }

        ResponseAssert::hasErrors($response);
        ResponseAssert::absentKey($response, 'data');

        return $response;
    }

    /**
     * @throws RuntimeException
     */
    protected function query(Query $query, HttpMethod $method = HttpMethod::GET): array
    {
        try {
            $response = $this->dataExtractor->extract($method->isGet() ? $this->get($query) : $this->post($query));
        } catch (UnauthorizedException $exception) {
            throw $exception;
        } catch (ClientExceptionInterface $exception) {
            throw ResponseException::badRequest($exception->getMessage());
        } catch (JsonException $exception) {
            throw ResponseException::hasNotValidJson($exception->getMessage());
        } catch (Throwable $exception) {
            throw ResponseException::unknownError($exception->getMessage());
        }

        ResponseAssert::hasErrors($response);
        ResponseAssert::absentKey($response, 'data');

        return $response;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws UnauthorizedException
     */
    abstract public function get(Query $query): ResponseInterface;

    /**
     * @throws ClientExceptionInterface
     */
    abstract public function post(Query $mutation): ResponseInterface;
}
