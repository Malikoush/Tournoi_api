<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240225234842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arbitre (id INT AUTO_INCREMENT NOT NULL, equipe_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_20B2E66E6D861B89 (equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, tournoi_id INT NOT NULL, nom VARCHAR(100) NOT NULL, point INT DEFAULT 0 NOT NULL, statut VARCHAR(25) NOT NULL, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2449BA15F607770A (tournoi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_poule (id INT AUTO_INCREMENT NOT NULL, equipe_id INT NOT NULL, poule_id INT NOT NULL, INDEX IDX_A0137DCA6D861B89 (equipe_id), INDEX IDX_A0137DCA26596FD8 (poule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, equipe_id INT NOT NULL, nom VARCHAR(100) NOT NULL, INDEX IDX_FD71A9C56D861B89 (equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, tournoi_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_AB55E24FF607770A (tournoi_id), INDEX IDX_AB55E24FFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phase (id INT AUTO_INCREMENT NOT NULL, tournoi_id INT NOT NULL, nom VARCHAR(100) NOT NULL, INDEX IDX_B1BDD6CBF607770A (tournoi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poule (id INT AUTO_INCREMENT NOT NULL, phase_id INT NOT NULL, nom VARCHAR(255) NOT NULL, equipe_max INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_FA1FEB4099091188 (phase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, poule_id INT NOT NULL, equipe1_id INT DEFAULT NULL, equipe2_id INT DEFAULT NULL, arbitre_id INT DEFAULT NULL, terrain_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, heure TIME DEFAULT NULL, fini TINYINT(1) NOT NULL, INDEX IDX_460C35ED26596FD8 (poule_id), INDEX IDX_460C35ED4265900C (equipe1_id), INDEX IDX_460C35ED50D03FE2 (equipe2_id), INDEX IDX_460C35ED943A5F0 (arbitre_id), INDEX IDX_460C35ED8A2D8B41 (terrain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `set` (id INT AUTO_INCREMENT NOT NULL, rencontre_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E61425DC6CFC0818 (rencontre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE terrain (id INT AUTO_INCREMENT NOT NULL, tournoi_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_C87653B1F607770A (tournoi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournoi (id INT AUTO_INCREMENT NOT NULL, organisateur_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, equipe_max INT NOT NULL, niveau VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_18AFD9DFD936B2FA (organisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, pseudo VARCHAR(100) NOT NULL, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE arbitre ADD CONSTRAINT FK_20B2E66E6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15F607770A FOREIGN KEY (tournoi_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE equipe_poule ADD CONSTRAINT FK_A0137DCA6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE equipe_poule ADD CONSTRAINT FK_A0137DCA26596FD8 FOREIGN KEY (poule_id) REFERENCES poule (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C56D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FF607770A FOREIGN KEY (tournoi_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE phase ADD CONSTRAINT FK_B1BDD6CBF607770A FOREIGN KEY (tournoi_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE poule ADD CONSTRAINT FK_FA1FEB4099091188 FOREIGN KEY (phase_id) REFERENCES phase (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED26596FD8 FOREIGN KEY (poule_id) REFERENCES poule (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED4265900C FOREIGN KEY (equipe1_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED50D03FE2 FOREIGN KEY (equipe2_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED943A5F0 FOREIGN KEY (arbitre_id) REFERENCES arbitre (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED8A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('ALTER TABLE `set` ADD CONSTRAINT FK_E61425DC6CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE terrain ADD CONSTRAINT FK_C87653B1F607770A FOREIGN KEY (tournoi_id) REFERENCES tournoi (id)');
        $this->addSql('ALTER TABLE tournoi ADD CONSTRAINT FK_18AFD9DFD936B2FA FOREIGN KEY (organisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arbitre DROP FOREIGN KEY FK_20B2E66E6D861B89');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15F607770A');
        $this->addSql('ALTER TABLE equipe_poule DROP FOREIGN KEY FK_A0137DCA6D861B89');
        $this->addSql('ALTER TABLE equipe_poule DROP FOREIGN KEY FK_A0137DCA26596FD8');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C56D861B89');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FF607770A');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FFB88E14F');
        $this->addSql('ALTER TABLE phase DROP FOREIGN KEY FK_B1BDD6CBF607770A');
        $this->addSql('ALTER TABLE poule DROP FOREIGN KEY FK_FA1FEB4099091188');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED26596FD8');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED4265900C');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED50D03FE2');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED943A5F0');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED8A2D8B41');
        $this->addSql('ALTER TABLE `set` DROP FOREIGN KEY FK_E61425DC6CFC0818');
        $this->addSql('ALTER TABLE terrain DROP FOREIGN KEY FK_C87653B1F607770A');
        $this->addSql('ALTER TABLE tournoi DROP FOREIGN KEY FK_18AFD9DFD936B2FA');
        $this->addSql('DROP TABLE arbitre');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE equipe_poule');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE phase');
        $this->addSql('DROP TABLE poule');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('DROP TABLE `set`');
        $this->addSql('DROP TABLE terrain');
        $this->addSql('DROP TABLE tournoi');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
