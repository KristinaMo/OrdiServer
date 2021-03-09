<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309143105 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category DROP nom_reparation');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D12469DE2');
        $this->addSql('DROP INDEX IDX_8FDF219D12469DE2 ON reparation');
        $this->addSql('ALTER TABLE reparation CHANGE category_id nom_reparation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D85278E24 FOREIGN KEY (nom_reparation_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_8FDF219D85278E24 ON reparation (nom_reparation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D85278E24');
        $this->addSql('DROP TABLE ville');
        $this->addSql('ALTER TABLE category ADD nom_reparation VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX IDX_8FDF219D85278E24 ON reparation');
        $this->addSql('ALTER TABLE reparation CHANGE nom_reparation_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_8FDF219D12469DE2 ON reparation (category_id)');
    }
}
