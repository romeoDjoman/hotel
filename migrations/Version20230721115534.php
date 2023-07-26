<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230721115534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, prix INT NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spa (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, duree VARCHAR(255) NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD restaurant_id INT NOT NULL, ADD spa_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DDF3CB247 FOREIGN KEY (spa_id) REFERENCES spa (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DB1E7706E ON commande (restaurant_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DDF3CB247 ON commande (spa_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DB1E7706E');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DDF3CB247');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE spa');
        $this->addSql('DROP INDEX IDX_6EEAA67DB1E7706E ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DDF3CB247 ON commande');
        $this->addSql('ALTER TABLE commande DROP restaurant_id, DROP spa_id');
    }
}
