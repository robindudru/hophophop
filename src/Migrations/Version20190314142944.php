<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190314142944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_others ADD recipes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe_others ADD CONSTRAINT FK_ADA7A9D7FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id)');
        $this->addSql('CREATE INDEX IDX_ADA7A9D7FDF2B1FA ON recipe_others (recipes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_others DROP FOREIGN KEY FK_ADA7A9D7FDF2B1FA');
        $this->addSql('DROP INDEX IDX_ADA7A9D7FDF2B1FA ON recipe_others');
        $this->addSql('ALTER TABLE recipe_others DROP recipes_id');
    }
}
