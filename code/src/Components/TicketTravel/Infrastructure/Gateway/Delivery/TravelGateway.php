<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery;

use GraphQL\Query;
use Travel\Components\TicketTravel\Features\Travel\Travel\PaginationDto;
use Travel\Components\TicketTravel\Features\Travel\Travel\TravelDto;
use Travel\Components\TicketTravel\Features\Travel\Travel\TravelGatewayInterface;
use Travel\Components\TicketTravel\Features\Travel\Travel\TravelListDto;
use Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\Mutation\CreateMutation;
use Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\Mutation\UpdateMutation;
use Travel\Components\TicketTravel\Infrastructure\Gateway\Delivery\Query\ReadQuery;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\GraphQLGateway;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\QueryToJsonTransformer;
use Travel\Infrastructure\Http\ResponseExtractor\ResponseDataExtractorInterface;
use Psr\Http\Message\ResponseInterface;

final class TravelGateway extends GraphQLGateway implements TravelGatewayInterface
{
    public function __construct(ResponseDataExtractorInterface $dataExtractor, private DeliveryClient $client)
    {
        parent::__construct($dataExtractor);
    }

    public function create(string $name, string $serviceId, string $methodId, string $strategy, int $status): int
    {
        $response = $this->mutation(CreateMutation::createTravel($name, $serviceId, $methodId, $strategy, $status));

        ResponseAssert::absentKey($response['data'], 'travelTravel');

        return (int) $response['data']['travelTravel']['id'];
    }

    public function update(int $id, string $name, string $serviceId, string $methodId, int $status): int
    {
        $response = $this->mutation(UpdateMutation::updateTravel($id, $name, $serviceId, $methodId, $status));

        ResponseAssert::absentKey($response['data'], 'travelTravel');

        return (int) $response['data']['travelTravel']['id'];
    }

    public function read(int $id): TravelDto
    {
        $response = $this->query(ReadQuery::readTravel($id));

        ResponseAssert::absentKey($response['data'], 'travelTravel');

        return TravelDto::fromArray($response['data']['travelTravel']);
    }

    public function list(int $page, int $itemsPerPage, array $filters): TravelListDto
    {
        $response = $this->query(ReadQuery::readTravelList($page, $itemsPerPage, $filters));

        ResponseAssert::absentKey($response['data'], 'travelTravels');
        ResponseAssert::absentKey($response['pagination'], 'travelTravels');

        return new TravelListDto(
            array_map(
                static fn (array $tariff): TravelDto => TravelDto::fromArray($tariff),
                $response['data']['travelTravels']
            ), PaginationDto::fromArray($response['pagination']['travelTravels'])
        );
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
