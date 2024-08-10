<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810213301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'materials';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE materials (
            `id` INT AUTO_INCREMENT NOT NULL,
            `name` varchar(100) NOT NULL,
            `description` varchar(100) NOT NULL,
            `price` varchar(100) NOT NULL,
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
