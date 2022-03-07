<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128125422 extends AbstractMigration
{
    final const TABLE = 'action_log';

    public function up(Schema $schema): void
    {
        $this->addSql(sprintf('ALTER TABLE %s ADD COLUMN client JSONB', self::TABLE));
        $this->addSql(sprintf('ALTER TABLE %s ADD COLUMN data JSONB', self::TABLE));
    }

    public function down(Schema $schema): void
    {
        $this->addSql(sprintf('ALTER TABLE %s DROP COLUMN "user"', self::TABLE));
        $this->addSql(sprintf('ALTER TABLE %s DROP COLUMN data', self::TABLE));
    }
}
