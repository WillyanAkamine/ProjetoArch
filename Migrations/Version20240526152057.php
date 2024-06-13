<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526152057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'OBRA';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `constructions` (
            `id` int NOT NULL AUTO_INCREMENT,
            `description` text,
            `title` varchar(100) NOT NULL,
            `progress` int DEFAULT NULL,
            `created_at` timestamp DEFAULT NOW(),
            `user_id` int NOT NULL,
            `pdf_id` int NOT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`pdf_id`) REFERENCES pdf(`id`),
            FOREIGN KEY (`user_id`) REFERENCES users (`id`)
          )");

        $this->addSql("CREATE TABLE IF NOT EXISTS `constructions_has_pdf` (
            `id`                int NOT NULL AUTO_INCREMENT,
            `construction_id`   int NOT NULL,
            `pdf_id`            int NOT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`construction_id`) REFERENCES constructions (`id`),
            FOREIGN KEY (`pdf_id`) REFERENCES pdf (`id`)
          )");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
