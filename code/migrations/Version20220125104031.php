<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * @see Task: MH-77
 */
final class Version20220125104031 extends AbstractMigration
{
    final const TABLE = 'action_log';

    public function getDescription(): string
    {
        return sprintf('Create table "%s"', self::TABLE);
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE);
        $table->addColumn('id', 'integer', array('autoincrement' => true));

        $table->addColumn('project', Types::STRING);
        $table->addColumn('method', Types::STRING);
        $table->addColumn('created_at', Types::DATETIME_MUTABLE);

        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE);
    }
}
