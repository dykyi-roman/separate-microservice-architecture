<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\GraphQL\Server;

use GraphQL\Error\InvariantViolation;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Error\FormattedError;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Response\InvalidJsonFormatResponse;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Response\InvalidSchemaTypeResponse;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Response\UnexpectedExceptionResponse;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\Server\Middleware\MiddlewareInterface;
use Travel\Infrastructure\Http\HttpStatus;
use Travel\Infrastructure\Http\Request;
use Travel\Infrastructure\Http\Response;
use JsonException;
use Throwable;

final class Server
{
    /**
     * @var MiddlewareInterface[]
     */
    private array $middleware;

    public function __construct(private Schema $schema, MiddlewareInterface ...$middleware)
    {
        $this->middleware = $middleware;
    }

    public function run(Request $request): Response
    {
        try {
            $this->schema->assertValid();
            $input = (array) json_decode($request->content, true, 512, JSON_THROW_ON_ERROR);
            $query = GraphQL::executeQuery(
                $this->schema,
                (string) $input['query'],
                null,
                null,
                array_key_exists('variables', $input) ? $input['variables'] : []
            );
            $query->setErrorFormatter(static function (Throwable $exception) {
                return FormattedError::createFromException($exception);
            });
        } catch (InvariantViolation $exception) {
            return InvalidSchemaTypeResponse::create($exception->getMessage());
        } catch (JsonException $exception) {
            return InvalidJsonFormatResponse::create($exception->getMessage());
        } catch (Throwable $exception) {
            return UnexpectedExceptionResponse::create($exception->getMessage());
        }

        $arrayQuery = $query->toArray();
        $response = new Response(
            $arrayQuery,
            array_key_exists('errors', $arrayQuery) ? HttpStatus::INTERNAL_SERVER_ERROR : HttpStatus::OK
        );

        foreach ($this->middleware as $middleware) {
            $middleware->execute($request, $response);
        }

        return $response;
    }
}
