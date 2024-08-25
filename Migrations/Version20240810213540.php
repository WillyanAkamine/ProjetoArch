<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810213540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'payments';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE payments (
            `id` INT AUTO_INCREMENT NOT NULL,
            `description` varchar(100) NOT NULL,
            `progress` varchar(100) NOT NULL,
            `status` ENUM('Pago', 'Aberto', 'Vencido') NOT NULL,
            `created_at` datetime DEFAULT now() NOT NULL,
            `updated_at` datetime,
            `note_id` INT NOT NULL,
            PRIMARY KEY(`id`)
        )");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
