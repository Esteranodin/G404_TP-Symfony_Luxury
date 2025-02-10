<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210143808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate ADD gender_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('CREATE INDEX IDX_C8B28E44708A0E0 ON candidate (gender_id)');
        $this->addSql('ALTER TABLE gender DROP FOREIGN KEY FK_C7470A427D5FB314');
        $this->addSql('DROP INDEX UNIQ_C7470A427D5FB314 ON gender');
        $this->addSql('ALTER TABLE gender DROP candidates_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44708A0E0');
        $this->addSql('DROP INDEX IDX_C8B28E44708A0E0 ON candidate');
        $this->addSql('ALTER TABLE candidate DROP gender_id');
        $this->addSql('ALTER TABLE gender ADD candidates_id INT NOT NULL');
        $this->addSql('ALTER TABLE gender ADD CONSTRAINT FK_C7470A427D5FB314 FOREIGN KEY (candidates_id) REFERENCES candidate (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7470A427D5FB314 ON gender (candidates_id)');
    }
}
