<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208161935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_client ADD sexe_id INT NOT NULL');
        $this->addSql('ALTER TABLE info_client ADD CONSTRAINT FK_A995B03448F3B3C FOREIGN KEY (sexe_id) REFERENCES sexe (id)');
        $this->addSql('CREATE INDEX IDX_A995B03448F3B3C ON info_client (sexe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_client DROP FOREIGN KEY FK_A995B03448F3B3C');
        $this->addSql('DROP INDEX IDX_A995B03448F3B3C ON info_client');
        $this->addSql('ALTER TABLE info_client DROP sexe_id');
    }
}
