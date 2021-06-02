<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601122912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA51197E709F');
        $this->addSql('ALTER TABLE films_categories DROP FOREIGN KEY FK_3C3B0D66A21214B7');
        $this->addSql('ALTER TABLE films_categories DROP FOREIGN KEY FK_3C3B0D66939610EE');
        $this->addSql('ALTER TABLE realisateur DROP FOREIGN KEY FK_47933EFE939610EE');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE films');
        $this->addSql('DROP TABLE films_categories');
        $this->addSql('DROP TABLE realisateur');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, commentaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, note INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ordre_affichage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE films (id INT AUTO_INCREMENT NOT NULL, avis_id INT DEFAULT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, synopsis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_sortie DATE NOT NULL, image_affiche VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image_carre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_CEECCA51197E709F (avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE films_categories (films_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_3C3B0D66939610EE (films_id), INDEX IDX_3C3B0D66A21214B7 (categories_id), PRIMARY KEY(films_id, categories_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE realisateur (id INT AUTO_INCREMENT NOT NULL, films_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nationalite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_47933EFE939610EE (films_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE films_categories ADD CONSTRAINT FK_3C3B0D66939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_categories ADD CONSTRAINT FK_3C3B0D66A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realisateur ADD CONSTRAINT FK_47933EFE939610EE FOREIGN KEY (films_id) REFERENCES films (id)');
        $this->addSql('DROP TABLE item');
    }
}
