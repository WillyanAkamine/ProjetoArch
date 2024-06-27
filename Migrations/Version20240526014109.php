<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526014109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'NOTAS A PAGAR';
    }

    public function up(Schema $schema): void
    {
        $this->addSql ("CREATE TABLE IF NOT EXISTS `notes` (
            `id` int NOT NULL AUTO_INCREMENT,
            `description` text,
            `value` decimal(10,2) DEFAULT NULL,
            `status` enum('Paga','Em Aberto') DEFAULT 'Em Aberto',
            `user_id` int NOT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`user_id`) REFERENCES users (`id`)
          )");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
