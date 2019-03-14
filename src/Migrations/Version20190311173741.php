<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311173741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE malt_shopping');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE malt_shopping (id INT AUTO_INCREMENT NOT NULL, reseller_id INT NOT NULL, malt_id INT NOT NULL, url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_63BC582F953A9F01 (malt_id), INDEX IDX_63BC582F91E6A19D (reseller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE malt_shopping ADD CONSTRAINT FK_63BC582F91E6A19D FOREIGN KEY (reseller_id) REFERENCES reseller (id)');
        $this->addSql('ALTER TABLE malt_shopping ADD CONSTRAINT FK_63BC582F953A9F01 FOREIGN KEY (malt_id) REFERENCES malt (id)');
    }
}
