<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613000601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id CHAR(36) NOT NULL, name VARCHAR(70) DEFAULT NULL, code VARCHAR(5) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE discipline (id CHAR(36) NOT NULL, name VARCHAR(70) NOT NULL, code VARCHAR(5) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE glossary (id CHAR(36) NOT NULL, discipline_id CHAR(36) DEFAULT NULL, en VARCHAR(200) DEFAULT NULL, pt VARCHAR(200) DEFAULT NULL, es VARCHAR(200) DEFAULT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B0850B43A5522701 ON glossary (discipline_id)');
        $this->addSql('COMMENT ON COLUMN glossary.created_on IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE glossary_project (glossary_id CHAR(36) NOT NULL, project_id CHAR(36) NOT NULL, PRIMARY KEY(glossary_id, project_id))');
        $this->addSql('CREATE INDEX IDX_A0542D186ABB587D ON glossary_project (glossary_id)');
        $this->addSql('CREATE INDEX IDX_A0542D18166D1F9C ON glossary_project (project_id)');
        $this->addSql('CREATE TABLE project (id CHAR(36) NOT NULL, client_id CHAR(36) DEFAULT NULL, hatch_number VARCHAR(7) NOT NULL, client_number VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE19EB6921 ON project (client_id)');
        $this->addSql('ALTER TABLE glossary ADD CONSTRAINT FK_B0850B43A5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE glossary_project ADD CONSTRAINT FK_A0542D186ABB587D FOREIGN KEY (glossary_id) REFERENCES glossary (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE glossary_project ADD CONSTRAINT FK_A0542D18166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE glossary DROP CONSTRAINT FK_B0850B43A5522701');
        $this->addSql('ALTER TABLE glossary_project DROP CONSTRAINT FK_A0542D186ABB587D');
        $this->addSql('ALTER TABLE glossary_project DROP CONSTRAINT FK_A0542D18166D1F9C');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE19EB6921');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE discipline');
        $this->addSql('DROP TABLE glossary');
        $this->addSql('DROP TABLE glossary_project');
        $this->addSql('DROP TABLE project');
    }
}
