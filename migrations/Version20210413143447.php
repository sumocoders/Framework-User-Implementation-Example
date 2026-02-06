<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210413143447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'User entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE user (
                id INT AUTO_INCREMENT NOT NULL,
                email VARCHAR(180) NOT NULL,
                password VARCHAR(255) DEFAULT NULL,
                enabled TINYINT(1) NOT NULL,
                roles JSON NOT NULL,
                confirmation_token VARCHAR(255) DEFAULT NULL,
                confirmation_requested_at DATETIME DEFAULT NULL,
                confirmed_at DATETIME DEFAULT NULL,
                password_reset_token VARCHAR(255) DEFAULT NULL,
                password_requested_at DATETIME DEFAULT NULL,
                totp_secret VARCHAR(255) DEFAULT NULL,
                backup_codes JSON NOT NULL,
                trusted_version INT NOT NULL,
                UNIQUE INDEX UNIQ_8D93D649E7927C74 (email),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL
        );
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
