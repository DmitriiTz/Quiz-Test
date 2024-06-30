<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240628141103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quiz_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, text VARCHAR(255) NOT NULL, answers JSON NOT NULL, correct_answers JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE quiz_result (id INT NOT NULL, question_id INT DEFAULT NULL, user_id VARCHAR(255) NOT NULL, answers JSON NOT NULL, is_correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FE2E314A1E27F6BF ON quiz_result (question_id)');
        $this->addSql('ALTER TABLE quiz_result ADD CONSTRAINT FK_FE2E314A1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quiz_result_id_seq CASCADE');
        $this->addSql('ALTER TABLE quiz_result DROP CONSTRAINT FK_FE2E314A1E27F6BF');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quiz_result');
    }
}
