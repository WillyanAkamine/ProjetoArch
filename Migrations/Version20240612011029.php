<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240612011029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ORÇAMENTO';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `budget` (
            `id` int NOT NULL AUTO_INCREMENT,
            `title` varchar(100) NOT NULL,
            `description` text,
            `user_id` int NOT NULL,
            `accepted` boolean DEFAULT 0,
            `pdf_id` int NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`user_id`) REFERENCES users(`id`),
            FOREIGN KEY (`pdf_id`) REFERENCES pdf(`id`)
          )");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
