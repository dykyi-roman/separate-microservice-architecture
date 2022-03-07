<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel;

use GraphQL\Query;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\FolderDto;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Folder\SmartTravelGatewayInterface;
use Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation\CreateMutation;
use Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation\DeleteMutation;
use Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Mutation\UpdateMutation;
use Travel\Components\TicketTravel\Infrastructure\Gateway\SmartTravel\Query\ReadQuery;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\GraphQLGateway;
use Travel\Components\TicketTravel\Infrastructure\GraphQL\QueryToJsonTransformer;
use Travel\Infrastructure\Http\ResponseExtractor\ResponseDataExtractorInterface;
use Psr\Http\Message\ResponseInterface;

final class FolderGateway extends GraphQLGateway implements SmartTravelGatewayInterface
{
    public function __construct(ResponseDataExtractorInterface $dataExtractor, private SmartTravelClient $client)
    {
        parent::__construct($dataExtractor);
    }

    public function readSmartTravel(int $travelId): FolderDto
    {
        $response = $this->query(ReadQuery::smartFolder($travelId));

        ResponseAssert::absentKey($response['data'], 'smartFolder');
        ResponseAssert::isEmpty($response['data'], 'smartFolder');

        return FolderDto::fromArray($response['data']['smartFolder']);
    }

    public function createSmartTravel(string $title): int
    {
        $response = $this->mutation(CreateMutation::smartFolder($title));

        ResponseAssert::absentKey($response['data'], 'createSmartTravel');

        return (int) $response['data']['createSmartTravel']['id'];
    }

    public function createQuery(int $travelId): int
    {
        $response = $this->mutation(CreateMutation::query($travelId, ['GOODS_ID']));

        ResponseAssert::absentKey($response['data'], 'createQuery');

        return (int) $response['data']['createQuery']['id'];
    }

    public function updateSmartTravel(int $travelId, string $title): void
    {
        $this->mutation(UpdateMutation::smartFolder($travelId, $title));
    }

    public function deleteSmartTravel(int $travelId): void
    {
        $this->mutation(DeleteMutation::smartFolder($travelId));
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
