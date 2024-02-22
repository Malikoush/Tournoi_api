<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221235527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arbitre (id INT AUTO_INCREMENT NOT NULL, equipe_id_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_20B2E66E254808DD (equipe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, tournoi_id_id INT NOT NULL, nom VARCHAR(100) NOT NULL, point INT DEFAULT 0 NOT NULL, statut VARCHAR(25) NOT NULL, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2449BA1595CC3A82 (tournoi_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_poule (equipe_id INT NOT NULL, poule_id INT NOT NULL, INDEX IDX_A0137DCA6D861B89 (equipe_id), INDEX IDX_A0137DCA26596FD8 (poule_id), PRIMARY KEY(equipe_id, poule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, equipe_id_id INT NOT NULL, nom VARCHAR(100) NOT NULL, INDEX IDX_FD71A9C5254808DD (equipe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phase (id INT AUTO_INCREMENT NOT NULL, tournoi_id_id INT NOT NULL, nom VARCHAR(100) NOT NULL, INDEX IDX_B1BDD6CB95CC3A82 (tournoi_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poule (id INT AUTO_INCREMENT NOT NULL, phase_id_id INT NOT NULL, nom VARCHAR(255) NOT NULL, equipe_max INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_FA1FEB40A3621425 (phase_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, poule_id_id INT NOT NULL, equipe1_id_id INT DEFAULT NULL, equipe2_id_id INT DEFAULT NULL, arbitre_id_id INT DEFAULT NULL, terrain_id_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, heure TIME DEFAULT NULL, fini TINYINT(1) NOT NULL, INDEX IDX_460C35ED15093FA6 (poule_id_id), INDEX IDX_460C35ED23C223DB (equipe1_id_id), INDEX IDX_460C35ED122A3946 (equipe2_id_id), INDEX IDX_460C35EDEF20EE6F (arbitre_id_id), INDEX IDX_460C35ED8AB13FB8 (terrain_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `set` (id INT AUTO_INCREMENT NOT NULL, rencontre_id_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E61425DC8A603AB (rencontre_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE terrain (id INT AUTO_INCREMENT NOT NULL, tournoi_id_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_C87653B195CC3A82 (tournoi_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournoi (id INT AUTO_INCREMENT NOT NULL, organisateur_id_id INT NOT NULL, nom VARCHAR(100) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, equipe_max INT NOT NULL, niveau VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_18AFD9DFC75B6A4C (organisateur_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, pseudo VARCHAR(100) NOT NULL, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_tournoi (utilisateur_id INT NOT NULL, tournoi_id INT NOT NULL, INDEX IDX_62A42E4DFB88E14F (utilisateur_id), INDEX IDX_62A42E4DF607770A (tournoi_id), PRIMARY KEY(utilisateur_id, tournoi_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE arbitre ADD CONSTRAINT FK_20B2E66E254808DD FOREIGN KEY (equipe_id_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1595CC3A82 FOREIGN KEY (tournoi_id_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE equipe_poule ADD CONSTRAINT FK_A0137DCA6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_poule ADD CONSTRAINT FK_A0137DCA26596FD8 FOREIGN KEY (poule_id) REFERENCES poule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5254808DD FOREIGN KEY (equipe_id_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE phase ADD CONSTRAINT FK_B1BDD6CB95CC3A82 FOREIGN KEY (tournoi_id_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE poule ADD CONSTRAINT FK_FA1FEB40A3621425 FOREIGN KEY (phase_id_id) REFERENCES phase (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED15093FA6 FOREIGN KEY (poule_id_id) REFERENCES poule (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED23C223DB FOREIGN KEY (equipe1_id_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED122A3946 FOREIGN KEY (equipe2_id_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35EDEF20EE6F FOREIGN KEY (arbitre_id_id) REFERENCES arbitre (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED8AB13FB8 FOREIGN KEY (terrain_id_id) REFERENCES terrain (id)');
        $this->addSql('ALTER TABLE `set` ADD CONSTRAINT FK_E61425DC8A603AB FOREIGN KEY (rencontre_id_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE terrain ADD CONSTRAINT FK_C87653B195CC3A82 FOREIGN KEY (tournoi_id_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE tournoi ADD CONSTRAINT FK_18AFD9DFC75B6A4C FOREIGN KEY (organisateur_id_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur_tournoi ADD CONSTRAINT FK_62A42E4DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_tournoi ADD CONSTRAINT FK_62A42E4DF607770A FOREIGN KEY (tournoi_id) REFERENCES tournoi (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arbitre DROP FOREIGN KEY FK_20B2E66E254808DD');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1595CC3A82');
        $this->addSql('ALTER TABLE equipe_poule DROP FOREIGN KEY FK_A0137DCA6D861B89');
        $this->addSql('ALTER TABLE equipe_poule DROP FOREIGN KEY FK_A0137DCA26596FD8');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5254808DD');
        $this->addSql('ALTER TABLE phase DROP FOREIGN KEY FK_B1BDD6CB95CC3A82');
        $this->addSql('ALTER TABLE poule DROP FOREIGN KEY FK_FA1FEB40A3621425');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED15093FA6');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED23C223DB');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED122A3946');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35EDEF20EE6F');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED8AB13FB8');
        $this->addSql('ALTER TABLE `set` DROP FOREIGN KEY FK_E61425DC8A603AB');
        $this->addSql('ALTER TABLE terrain DROP FOREIGN KEY FK_C87653B195CC3A82');
        $this->addSql('ALTER TABLE tournoi DROP FOREIGN KEY FK_18AFD9DFC75B6A4C');
        $this->addSql('ALTER TABLE utilisateur_tournoi DROP FOREIGN KEY FK_62A42E4DFB88E14F');
        $this->addSql('ALTER TABLE utilisateur_tournoi DROP FOREIGN KEY FK_62A42E4DF607770A');
        $this->addSql('DROP TABLE arbitre');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE equipe_poule');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE phase');
        $this->addSql('DROP TABLE poule');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('DROP TABLE `set`');
        $this->addSql('DROP TABLE terrain');
        $this->addSql('DROP TABLE tournoi');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_tournoi');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
