<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312132311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reparation ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219DF675F31B FOREIGN KEY (author_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8FDF219DF675F31B ON reparation (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219DF675F31B');
        $this->addSql('DROP INDEX UNIQ_8FDF219DF675F31B ON reparation');
        $this->addSql('ALTER TABLE reparation DROP author_id');
    }
}
