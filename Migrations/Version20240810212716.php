<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810212716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'roles';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE roles (
            `id` INT AUTO_INCREMENT NOT NULL, 
            `label` decimal(10,2) NOT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime,
            PRIMARY KEY(`id`)
        )");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
