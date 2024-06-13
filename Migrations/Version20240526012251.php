<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526012251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'PDF';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE pdf (
            `id` INT AUTO_INCREMENT NOT NULL, 
            `name` VARCHAR(255) NOT NULL,
            `user_id` INT NOT NULL,
            `category` ENUM('Construction', 'Notes', 'Cost') NOT NULL,
            `construction_id`
            `notes_id`
            PRIMARY KEY(`id`),
            FOREIGN KEY (`user_id`) REFERENCES users (`id`)
        )");
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
