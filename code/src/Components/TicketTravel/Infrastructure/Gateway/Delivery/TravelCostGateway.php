<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery;

use GraphQL\Query;
use Travel\Components\TicketTravel\Features\Travel\TravelCost\TravelCostDto;
use Travel\Components\TicketTravel\Features\Travel\TravelCost\TravelCostGatewayInterface;
use Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\Mutation\CreateMutation;
use Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\Mutation\UpdateMutation;
use Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\Query\ReadQuery;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\GraphQLGateway;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\QueryToJsonTransformer;
use Travel\Infrastructure\Http\ResponseExtractor\ResponseDataExtractorInterface;
use Psr\Http\Message\ResponseInterface;

final class TravelCostGateway extends GraphQLGateway implements TravelCostGatewayInterface
{
    public function __construct(ResponseDataExtractorInterface $dataExtractor, private DeliveryClient $client)
    {
        parent::__construct($dataExtractor);
    }

    /**
     * @return TravelCostDto[]
     */
    public function listOfTravelCosts(int $tariffId): array
    {
        $response = $this->query(ReadQuery::listOfTravelCosts($tariffId));
        ResponseAssert::absentKey($response['data'], 'travelTravelCosts');

        return array_map(
            static fn (array $tariffCost): TravelCostDto => TravelCostDto::fromArray($tariffCost),
            $response['data']['travelTravelCosts']
        );
    }

    public function create(
        int $tariffId,
        string $name,
        float $limit,
        float $price,
        string $locationZoneId,
        int $smartFolderId,
        int $status
    ): int {
        $response = $this->mutation(
            CreateMutation::createTravelCost($tariffId, $name, $limit, $price, $locationZoneId, $smartFolderId, $status)
        );

        ResponseAssert::absentKey($response['data'], 'travelTravelCost');

        return (int) $response['data']['travelTravelCost']['id'];
    }

    public function update(
        int $id,
        string $name,
        float $limit,
        float $price,
        string $locationZoneId,
        int $smartFolderId,
        int $status
    ): int {
        $response = $this->mutation(
            UpdateMutation::updateTravelCost($id, $name, $limit, $price, $locationZoneId, $smartFolderId, $status)
        );

        ResponseAssert::absentKey($response['data'], 'travelTravelCost');

        return (int) $response['data']['travelTravelCost']['id'];
    }

    public function get(Query $query): ResponseInterface
    {
        return $this->client->get((string) new QueryToJsonTransformer($query));
    }

    public function post(Query $mutation): ResponseInterface
    {
        return $this->client->post((string) new QueryToJsonTransformer($mutation));
    }
}
