<?php

declare(strict_types=1);

namespace Src\Infra\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211015203632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE municipality ADD geom geometry(POLYGON, 5641) NOT NULL');
        $this->addSql('ALTER TABLE municipality ALTER uf TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE municipality ALTER uf TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Municipality DROP geom');
        $this->addSql('ALTER TABLE Municipality ALTER uf TYPE CHAR(2)');
        $this->addSql('ALTER TABLE Municipality ALTER uf TYPE CHAR(2)');
    }
}
