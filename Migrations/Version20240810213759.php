<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810213759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'pdfs';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE pdfs (
            `id` INT AUTO_INCREMENT NOT NULL, 
            `name` VARCHAR(255) NOT NULL,
            `url` VARCHAR(255) NOT NULL,
            `created_at` datetime DEFAULT now() NOT NULL,
            `updated_at` datetime,
            PRIMARY KEY(`id`)
        )");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
