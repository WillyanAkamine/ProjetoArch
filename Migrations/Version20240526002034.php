<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526002034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration PDF';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE pdf (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
