<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810233438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE notes
        ADD CONSTRAINT fk_constructions_notes
        FOREIGN KEY (construction_id) REFERENCES constructions(id) ON DELETE CASCADE,
        ADD CONSTRAINT fk_pdfs_notes
        FOREIGN KEY (pdf_id) REFERENCES pdfs(id) ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
