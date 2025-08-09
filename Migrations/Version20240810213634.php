<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810213634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'budgets';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE budgets (
            `id` INT AUTO_INCREMENT NOT NULL,
            `title` varchar(100) NOT NULL,
            `description` varchar(100) NOT NULL,
            `value` varchar(100) NOT NULL,
            `status` ENUM('Pendente', 'Aceito', 'Nao_aceito') NOT NULL DEFAULT 'Pendente',
            `created_at` datetime DEFAULT now() NOT NULL,
            `updated_at` datetime,
            `construction_id` INT NOT NULL,
            `pdf_id` INT,
            PRIMARY KEY(`id`)
        )");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
