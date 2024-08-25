<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810213003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'constructions';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE constructions (
            `id` INT AUTO_INCREMENT NOT NULL, 
            `title` varchar(100) NOT NULL,
            `description` varchar(100) NOT NULL,
            `progress` varchar(100) NOT NULL,
            `address` varchar(100) NOT NULL,
            `zipcode` varchar(100) NOT NULL,
            `neighborhood` varchar(100) NOT NULL,
            `city` varchar(100) NOT NULL,
            `state` varchar(100) NOT NULL,
            `created_at` datetime DEFAULT now() NOT NULL,
            `updated_at` datetime,
            `user_id` INT NOT NULL,
            PRIMARY KEY(`id`)
        )");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
