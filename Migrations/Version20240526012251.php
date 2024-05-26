<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526012251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Custo de obra';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `costs` (
            `id` int NOT NULL AUTO_INCREMENT,
            `labor` decimal(10,2) NOT NULL,  /* mao de obra */
            `equip` decimal(10,2) NOT NULL, /*Equipamentos*/
            `third` decimal(10,2) NOT NULL, /*Teceiros*/
            `adm` decimal(10,2) NOT NULL, /*Taxa ADM*/
            `date` timestamp DEFAULT NOW(),
            `client_id` int NOT NULL,
            FOREIGN KEY (`client_id`) REFERENCES clients(`id`),
            PRIMARY KEY (`id`),
            KEY `id` (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=4");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
