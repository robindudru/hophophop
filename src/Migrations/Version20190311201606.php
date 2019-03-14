<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311201606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hop (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, alpha_acid NUMERIC(3, 1) NOT NULL, sburl VARCHAR(255) DEFAULT NULL, blurl VARCHAR(255) DEFAULT NULL, INDEX IDX_BE545DEC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hop_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hop ADD CONSTRAINT FK_BE545DEC54C8C93 FOREIGN KEY (type_id) REFERENCES hop_type (id)');
        $this->addSql('DROP TABLE recipes_malt');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hop DROP FOREIGN KEY FK_BE545DEC54C8C93');
        $this->addSql('CREATE TABLE recipes_malt (recipes_id INT NOT NULL, malt_id INT NOT NULL, INDEX IDX_465A112FDF2B1FA (recipes_id), INDEX IDX_465A112953A9F01 (malt_id), PRIMARY KEY(recipes_id, malt_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE recipes_malt ADD CONSTRAINT FK_465A112953A9F01 FOREIGN KEY (malt_id) REFERENCES malt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_malt ADD CONSTRAINT FK_465A112FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE hop');
        $this->addSql('DROP TABLE hop_type');
    }
}
