<?php

declare(strict_types=1);

namespace Travel\Components\TicketTravel\Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Travel\Components\TicketTravel\Features\Logger\ActionLogRepositoryInterface;
use Travel\Components\TicketTravel\Features\Logger\Entity\ActionLog;

final class ActionLogRepository extends ServiceEntityRepository implements ActionLogRepositoryInterface
{
    public function __construct(private ManagerRegistry $registry)
    {
        parent::__construct($registry, ActionLog::class);
    }

    public function add(ActionLog $actionLog): void
    {
        $entityManager = $this->registry->getManager();
        $entityManager->persist($actionLog);
    }

    public function save(): void
    {
        $entityManager = $this->registry->getManager();
        $entityManager->flush();
    }
}
