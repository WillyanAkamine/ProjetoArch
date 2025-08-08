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
        `material_id` INT NOT NULL,
        `budget_id` INT NOT NULL,
        `quantity` INT NOT NULL,
        PRIMARY KEY(`id`),
        FOREIGN KEY (`material_id`) REFERENCES materials(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`budget_id`) REFERENCES budgets(`id`) ON DELETE CASCADE
        )");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
