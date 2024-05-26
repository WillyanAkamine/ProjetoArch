<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526014109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql ("CREATE TABLE IF NOT EXISTS `notespayable` (
            `id` int NOT NULL AUTO_INCREMENT,
            `description` text,
            `value` decimal(10,2) DEFAULT NULL,
            `status` enum('Paga','Em Aberto') DEFAULT 'Em Aberto',
            PRIMARY KEY (`id`),
            KEY `ObraID` (`id`)
          ) ENGINE=MyISAM");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
