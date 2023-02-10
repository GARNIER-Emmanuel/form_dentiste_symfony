<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210090214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, date_commande DATE NOT NULL, prochain_rdv DATE NOT NULL, heure TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous_infoclient (rendez_vous_id INT NOT NULL, infoclient_id INT NOT NULL, INDEX IDX_615E92F491EF7EAA (rendez_vous_id), INDEX IDX_615E92F4201E572B (infoclient_id), PRIMARY KEY(rendez_vous_id, infoclient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rendez_vous_infoclient ADD CONSTRAINT FK_615E92F491EF7EAA FOREIGN KEY (rendez_vous_id) REFERENCES rendez_vous (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendez_vous_infoclient ADD CONSTRAINT FK_615E92F4201E572B FOREIGN KEY (infoclient_id) REFERENCES info_client (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendez_vous_infoclient DROP FOREIGN KEY FK_615E92F491EF7EAA');
        $this->addSql('ALTER TABLE rendez_vous_infoclient DROP FOREIGN KEY FK_615E92F4201E572B');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE rendez_vous_infoclient');
    }
}
