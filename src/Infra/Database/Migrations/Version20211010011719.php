<?php

declare(strict_types=1);

namespace Src\Infra\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211010011719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('CREATE TABLE Farm (id SERIAL NOT NULL, municipality_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, area DOUBLE PRECISION DEFAULT NULL, mf DOUBLE PRECISION DEFAULT NULL, geom geometry(POLYGON, 5641) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F8247F7BAE6F181C ON Farm (municipality_id)');
        $this->addSql('CREATE TABLE Municipality (id SERIAL NOT NULL, cod_ibge INT NOT NULL, name VARCHAR(150) NOT NULL, uf CHAR(2) NOT NULL, mf DOUBLE PRECISION NOT NULL, area DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE Farm ADD CONSTRAINT FK_F8247F7BAE6F181C FOREIGN KEY (municipality_id) REFERENCES Municipality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Farm DROP CONSTRAINT FK_F8247F7BAE6F181C');
        $this->addSql('DROP TABLE Farm');
        $this->addSql('DROP TABLE Municipality');
    }
}
