<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260512135528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add azure_object_id to user (optional — only needed for Azure SSO via HWI OAuth)';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('user');
        $table->addColumn('azure_object_id', 'string', ['length' => 36, 'notnull' => false]);
        $table->addUniqueIndex(['azure_object_id'], 'UNIQ_USER_AZURE_OID');
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable('user');
        $table->dropIndex('UNIQ_USER_AZURE_OID');
        $table->dropColumn('azure_object_id');
    }
}
