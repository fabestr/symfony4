<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190814104435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, artist_id_id INT NOT NULL, type VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, lieu VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, INDEX IDX_3BAE0AA71F48AE04 (artist_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support (id INT AUTO_INCREMENT NOT NULL, produit_id_id INT NOT NULL, type_support VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_8004EBA54FD8F9C3 (produit_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_commande (id INT AUTO_INCREMENT NOT NULL, numero_support_id INT DEFAULT NULL, numero_commande_id INT NOT NULL, INDEX IDX_3170B74B63E829A6 (numero_support_id), INDEX IDX_3170B74BCD55219B (numero_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE streaming (id INT AUTO_INCREMENT NOT NULL, prix DOUBLE PRECISION NOT NULL, titre_morceau VARCHAR(255) NOT NULL, qualite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, collection LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_streaming (user_id INT NOT NULL, streaming_id INT NOT NULL, INDEX IDX_26A39585A76ED395 (user_id), INDEX IDX_26A39585429AEC72 (streaming_id), PRIMARY KEY(user_id, streaming_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, artiste_id_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, date_production VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27B6D84A9 (artiste_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, numero_commande INT NOT NULL, date_commande DATETIME NOT NULL, montant DOUBLE PRECISION NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_6EEAA67DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, style VARCHAR(255) DEFAULT NULL, presentation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actualite (id INT AUTO_INCREMENT NOT NULL, thematique VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date_publication DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actualite_user (actualite_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C63578C2A2843073 (actualite_id), INDEX IDX_C63578C2A76ED395 (user_id), PRIMARY KEY(actualite_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA71F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA54FD8F9C3 FOREIGN KEY (produit_id_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B63E829A6 FOREIGN KEY (numero_support_id) REFERENCES support (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BCD55219B FOREIGN KEY (numero_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE user_streaming ADD CONSTRAINT FK_26A39585A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_streaming ADD CONSTRAINT FK_26A39585429AEC72 FOREIGN KEY (streaming_id) REFERENCES streaming (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27B6D84A9 FOREIGN KEY (artiste_id_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE actualite_user ADD CONSTRAINT FK_C63578C2A2843073 FOREIGN KEY (actualite_id) REFERENCES actualite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actualite_user ADD CONSTRAINT FK_C63578C2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B63E829A6');
        $this->addSql('ALTER TABLE user_streaming DROP FOREIGN KEY FK_26A39585429AEC72');
        $this->addSql('ALTER TABLE user_streaming DROP FOREIGN KEY FK_26A39585A76ED395');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE actualite_user DROP FOREIGN KEY FK_C63578C2A76ED395');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA54FD8F9C3');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BCD55219B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA71F48AE04');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27B6D84A9');
        $this->addSql('ALTER TABLE actualite_user DROP FOREIGN KEY FK_C63578C2A2843073');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE support');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE streaming');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_streaming');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE actualite');
        $this->addSql('DROP TABLE actualite_user');
    }
}
