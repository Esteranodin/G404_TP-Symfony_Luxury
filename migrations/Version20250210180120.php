<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210180120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL, candidate_id INT DEFAULT NULL, picture_path VARCHAR(255) DEFAULT NULL, cv_path VARCHAR(255) DEFAULT NULL, passport_path VARCHAR(255) DEFAULT NULL, INDEX IDX_635405991BD8781 (candidate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_635405991BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE candidate ADD current_location VARCHAR(255) DEFAULT NULL, ADD address VARCHAR(255) DEFAULT NULL, ADD country VARCHAR(255) DEFAULT NULL, ADD nationality VARCHAR(255) DEFAULT NULL, ADD birth_day DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', ADD birth_place VARCHAR(255) DEFAULT NULL, CHANGE gender_id gender_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_635405991BD8781');
        $this->addSql('DROP TABLE files');
        $this->addSql('ALTER TABLE candidate DROP current_location, DROP address, DROP country, DROP nationality, DROP birth_day, DROP birth_place, CHANGE gender_id gender_id INT DEFAULT NULL');
    }
}
