<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Features\Logger;

use Travel\Components\TicketTravel\Features\Logger\Entity\ActionLog;

interface ActionLogRepositoryInterface
{
    public function add(ActionLog $actionLog): void;

    public function save(): void;
}
