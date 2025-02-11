<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250211151337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidates DROP FOREIGN KEY FK_6A77F80C46E90E27');
        $this->addSql('ALTER TABLE candidates DROP FOREIGN KEY FK_6A77F80C8C3F36C7');
        $this->addSql('DROP TABLE sector_job');
        $this->addSql('DROP TABLE candidates');
        $this->addSql('DROP TABLE xp');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sector_job (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE candidates (id INT AUTO_INCREMENT NOT NULL, sector_job_id INT DEFAULT NULL, experience_id INT DEFAULT NULL, INDEX IDX_6A77F80C8C3F36C7 (sector_job_id), INDEX IDX_6A77F80C46E90E27 (experience_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE xp (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE candidates ADD CONSTRAINT FK_6A77F80C46E90E27 FOREIGN KEY (experience_id) REFERENCES xp (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE candidates ADD CONSTRAINT FK_6A77F80C8C3F36C7 FOREIGN KEY (sector_job_id) REFERENCES sector_job (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
