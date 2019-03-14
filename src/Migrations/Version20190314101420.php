<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190314101420 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipe_hops (id INT AUTO_INCREMENT NOT NULL, hop_id INT NOT NULL, recipe_id INT NOT NULL, weight NUMERIC(5, 2) NOT NULL, boil_time INT NOT NULL, INDEX IDX_5758F42BC3870B6 (hop_id), INDEX IDX_5758F4259D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_hops ADD CONSTRAINT FK_5758F42BC3870B6 FOREIGN KEY (hop_id) REFERENCES hop (id)');
        $this->addSql('ALTER TABLE recipe_hops ADD CONSTRAINT FK_5758F4259D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE recipe_hops');
    }
}
