<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition;

use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Enum\Equal;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Enum\Operator;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Type\FilterCondition;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Type\NumberCondition;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\Condition\Type\TextCondition;
use Travel\Components\TicketTravel\Features\Segment\SmartTravel\ErrorCode;
use Psr\Log\LoggerInterface;
use Throwable;

final class ConditionManager
{
    public function __construct(
        private SmartTravelGatewayInterface $smartFolderGateway,
        private LoggerInterface $logger
    ) {
    }

    public function createNumber(int $queryId, NumberCondition $condition): int
    {
        try {
            return $this->smartFolderGateway->createNumberCondition($queryId, (string) $condition);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw ConditionException::failedToAddCondition(ErrorCode::FAILED_TO_CREATE_NUMBER_CONDITION);
        }
    }

    public function updateNumber(int $queryId, int $conditionId, NumberCondition $condition): int
    {
        try {
            return $this->smartFolderGateway->updateNumberCondition($queryId, $conditionId, (string) $condition);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw ConditionException::failedToAddCondition(ErrorCode::FAILED_TO_UPDATE_NUMBER_CONDITION);
        }
    }

    public function createText(int $queryId, TextCondition $condition): int
    {
        try {
            return $this->smartFolderGateway->createTextCondition($queryId, (string) $condition);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw ConditionException::failedToAddCondition(ErrorCode::FAILED_TO_CREATE_TEXT_CONDITION);
        }
    }

    public function updateText(int $queryId, int $conditionId, TextCondition $condition): void
    {
        try {
            $this->smartFolderGateway->updateTextCondition($queryId, $conditionId, (string) $condition);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw ConditionException::failedToAddCondition(ErrorCode::FAILED_TO_UPDATE_TEXT_CONDITION);
        }
    }

    public function createFilter(int $queryId, FilterCondition $condition): int
    {
        try {
            return $this->smartFolderGateway->createFilter(
                $queryId,
                Equal::YES->value,
                Operator::AND_OPERATOR->value,
                $condition->filterValueList()
            );
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw ConditionException::failedToAddCondition(ErrorCode::FAILED_TO_CREATE_FILTER_CONDITION);
        }
    }

    public function updateFilter(int $queryId, int $conditionId, FilterCondition $condition): int
    {
        try {
            return $this->smartFolderGateway->updateFilter(
                $queryId,
                $conditionId,
                Equal::YES->value,
                Operator::AND_OPERATOR->value,
                $condition->filterValueList(),
            );
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw ConditionException::failedToAddCondition(ErrorCode::FAILED_TO_UPDATE_FILTER_CONDITION);
        }
    }

    public function deleteFilter(int $queryId, int $filterId): void
    {
        try {
            $this->smartFolderGateway->deleteFilter($queryId, $filterId);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw ConditionException::failedToDeleteFilter(ErrorCode::FAILED_TO_DELETE_FILTER);
        }
    }

    public function deleteCondition(int $queryId, int $conditionId, string $conditionType): void
    {
        try {
            $this->smartFolderGateway->deleteCondition($queryId, $conditionId, $conditionType);
        } catch (Throwable $exception) {
            $this->logger->error(
                implode('::', explode('\\', __METHOD__)),
                array_merge(['error' => $exception->getMessage()], ['data' => get_defined_vars()])
            );

            throw ConditionException::failedToDeleteCondition(ErrorCode::FAILED_TO_DELETE_CONDITION);
        }
    }
}
