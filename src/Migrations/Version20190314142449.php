<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190314142449 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE other_ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, sburl VARCHAR(255) DEFAULT NULL, blurl VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_others (id INT AUTO_INCREMENT NOT NULL, other_ingredient_id INT NOT NULL, weight NUMERIC(5, 2) NOT NULL, INDEX IDX_ADA7A9D7A5387C8A (other_ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_others ADD CONSTRAINT FK_ADA7A9D7A5387C8A FOREIGN KEY (other_ingredient_id) REFERENCES other_ingredient (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_others DROP FOREIGN KEY FK_ADA7A9D7A5387C8A');
        $this->addSql('DROP TABLE other_ingredient');
        $this->addSql('DROP TABLE recipe_others');
    }
}
