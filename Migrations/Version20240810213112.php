<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810213112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'schedules';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE schedules (
            `id` INT AUTO_INCREMENT NOT NULL, 
            `description` varchar(100) NOT NULL,
            `progress` varchar(100) NOT NULL,
            `start_date` datetime NOT NULL,
            `end_date` datetime,
            `status` ENUM('Inicio', 'Andamento', 'Finalizado') NOT NULL,
            `created_at` datetime DEFAULT now() NOT NULL,
            `updated_at` datetime,
            `construction_id` INT NOT NULL,
            PRIMARY KEY(`id`)
        )");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
