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
        $this->addSql(<<<'SQL'
            ALTER TABLE user
                ADD azure_object_id VARCHAR(36) DEFAULT NULL,
                ADD UNIQUE INDEX UNIQ_USER_AZURE_OID (azure_object_id)
        SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE user
                DROP INDEX UNIQ_USER_AZURE_OID,
                DROP COLUMN azure_object_id
        SQL
        );
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
