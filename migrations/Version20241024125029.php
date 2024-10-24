<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024125029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_billet (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, services_inclus VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD type_billet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F0517D68 FOREIGN KEY (type_billet_id) REFERENCES type_billet (id)');
        $this->addSql('CREATE INDEX IDX_42C84955F0517D68 ON reservation (type_billet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F0517D68');
        $this->addSql('DROP TABLE type_billet');
        $this->addSql('DROP INDEX IDX_42C84955F0517D68 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP type_billet_id');
    }
}
