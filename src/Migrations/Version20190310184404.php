<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190310184404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipes CHANGE original_gravity original_gravity NUMERIC(4, 3) DEFAULT NULL, CHANGE final_gravity final_gravity NUMERIC(4, 3) DEFAULT NULL, CHANGE alcohol alcohol NUMERIC(2, 1) DEFAULT NULL, CHANGE mash_guide mash_guide VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipes CHANGE mash_guide mash_guide VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE original_gravity original_gravity NUMERIC(3, 1) NOT NULL, CHANGE final_gravity final_gravity NUMERIC(3, 1) NOT NULL, CHANGE alcohol alcohol NUMERIC(2, 1) NOT NULL');
    }
}
