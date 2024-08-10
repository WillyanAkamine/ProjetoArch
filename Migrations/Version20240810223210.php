<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810223210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'materials_budgets';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE materials_budgets (
            `id` INT AUTO_INCREMENT NOT NULL, 
            `quantity` INT NOT NULL,
            PRIMARY KEY(`id`)
        )");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
