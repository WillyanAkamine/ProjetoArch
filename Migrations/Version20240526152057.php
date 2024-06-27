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
            `progress` int DEFAULT NULL,
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
