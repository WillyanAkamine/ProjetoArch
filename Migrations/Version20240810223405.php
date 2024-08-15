<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810223405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'foreings';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE users
                    ADD CONSTRAINT fk_roles_users
                    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
                ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
