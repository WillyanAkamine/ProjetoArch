<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810211512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'costs';
        
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE costs (
            `id` INT AUTO_INCREMENT NOT NULL, 
            `labor` decimal(10,2) NOT NULL,
            `equip` decimal(10,2) NOT NULL,
            `third` decimal(10,2) NOT NULL,
            `adm` decimal(10,2) NOT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime,
            `construction_id` INT NOT NULL,
            PRIMARY KEY(`id`)
        )");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
