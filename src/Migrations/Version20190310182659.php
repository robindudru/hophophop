<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190310182659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipes (id INT AUTO_INCREMENT NOT NULL, style_id INT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, author VARCHAR(255) NOT NULL, method VARCHAR(255) NOT NULL, boil_time INT DEFAULT NULL, batch_size INT NOT NULL, color INT NOT NULL, thumbs_up INT NOT NULL, malts LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', hops LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', yeast LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', mash_guide VARCHAR(255) NOT NULL, other_ingredients LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', orginal_gravity NUMERIC(4, 3) DEFAULT NULL, final_gravity NUMERIC(4, 3) DEFAULT NULL, alcohol NUMERIC(2, 1) DEFAULT NULL, INDEX IDX_A369E2B5BACD6074 (style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B5BACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE recipes');
    }
}
