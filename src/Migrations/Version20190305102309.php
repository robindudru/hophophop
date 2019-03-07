<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190305102309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipes ADD author VARCHAR(255) NOT NULL, ADD method VARCHAR(255) NOT NULL, ADD boil_time VARCHAR(255) DEFAULT NULL, ADD batch_size INT NOT NULL, ADD original_gravity INT NOT NULL, ADD boil_gravity INT NOT NULL, ADD final_gravity INT NOT NULL, ADD alcohol INT NOT NULL, ADD bitterness INT NOT NULL, ADD color INT NOT NULL, ADD thumbs_up INT NOT NULL, ADD malts LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD hops LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD yeast LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD mash_guide LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD other_ingredients LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipes DROP author, DROP method, DROP boil_time, DROP batch_size, DROP original_gravity, DROP boil_gravity, DROP final_gravity, DROP alcohol, DROP bitterness, DROP color, DROP thumbs_up, DROP malts, DROP hops, DROP yeast, DROP mash_guide, DROP other_ingredients');
    }
}
