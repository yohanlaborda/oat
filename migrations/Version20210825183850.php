<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210825183850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table question';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('question');
        $table->addColumn('id', 'string');
        $table->addColumn('text', 'string');
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('choices', 'json');

        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('question');
    }
}
