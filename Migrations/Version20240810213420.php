<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810213420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'notes';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE notes (
            `id` INT AUTO_INCREMENT NOT NULL,
            `description` varchar(100) NOT NULL,
            `value` varchar(100) NOT NULL,
            `status` varchar(100) NOT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime,
            `construction_id`INT NOT NULL,
            `pdf_id` INT NOT NULL,
            PRIMARY KEY(`id`)
        )");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
