<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel;

use GraphQL\Query;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\SmartTravelGatewayInterface;
use Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation\CreateMutation;
use Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation\DeleteMutation;
use Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation\ExecuteMutation;
use Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation\UpdateMutation;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\GraphQLGateway;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\QueryToJsonTransformer;
use Travel\Infrastructure\Http\ResponseExtractor\ResponseDataExtractorInterface;
use Psr\Http\Message\ResponseInterface;

final class ConditionGateway extends GraphQLGateway implements SmartTravelGatewayInterface
{
    public function __construct(ResponseDataExtractorInterface $dataExtractor, private SmartTravelClient $client)
    {
        parent::__construct($dataExtractor);
    }

    public function createTextCondition(int $queryId, string $condition): int
    {
        $response = $this->mutation(CreateMutation::textCondition($queryId, $condition));

        return (int) ($response['data']['addCondition']['id']);
    }

    public function updateTextCondition(int $queryId, int $conditionId, string $condition): int
    {
        $response = $this->mutation(UpdateMutation::textCondition($queryId, $conditionId, $condition));

        return (int) $response['data']['addCondition']['id'];
    }

    public function createNumberCondition(int $queryId, string $condition): int
    {
        $response = $this->mutation(CreateMutation::numberCondition($queryId, $condition));

        return (int) $response['data']['addCondition']['id'];
    }

    public function updateNumberCondition(int $queryId, int $conditionId, string $condition): int
    {
        $response = $this->mutation(UpdateMutation::numberCondition($queryId, $conditionId, $condition));

        return (int) $response['data']['updateCondition']['id'];
    }

    public function createFilter(int $queryId, string $condition, string $operator, array $filters): int
    {
        $response = $this->mutation(CreateMutation::filter($queryId, $condition, $operator, $filters));

        return (int) $response['data']['createFilterGoods']['id'];
    }

    public function updateFilter(
        int $queryId,
        int $conditionId,
        string $condition,
        string $operator,
        array $filters
    ): int {
        $response = $this->mutation(UpdateMutation::filter($queryId, $conditionId, $condition, $operator, $filters));

        return (int) $response['data']['updateFilterGoods']['id'];
    }

    public function deleteFilter(int $queryId, int $filterId): void
    {
        $this->mutation(DeleteMutation::filter($queryId, $filterId));
    }

    public function deleteCondition(int $queryId, int $conditionId, string $conditionType): void
    {
        $this->mutation(DeleteMutation::condition($queryId, $conditionId, $conditionType));
    }

    public function filtersExecute(int $queryId): void
    {
        $this->mutation(ExecuteMutation::filters($queryId));
    }

    public function get(Query $query): ResponseInterface
    {
        return $this->client->get((string) new QueryToJsonTransformer($query));
    }

    public function post(Query $mutation): ResponseInterface
    {
        return $this->client->get((string) new QueryToJsonTransformer($mutation));
    }
}
