<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810233445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
     
        $this->addSql("ALTER TABLE budgets
                ADD CONSTRAINT fk_constructions_budgets
                FOREIGN KEY (construction_id) REFERENCES constructions(id),
                ADD CONSTRAINT fk_pdfs_budgets
                FOREIGN KEY (pdf_id) REFERENCES pdfs(id)
                ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
