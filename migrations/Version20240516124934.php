<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516124934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE admin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON admin (username)');
        $this->addSql('ALTER TABLE category ALTER created_at SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE comment ALTER created_at SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE product ALTER created_at SET DEFAULT \'now()\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE admin_id_seq CASCADE');
        $this->addSql('DROP TABLE admin');
        $this->addSql('ALTER TABLE comment ALTER created_at SET DEFAULT \'2024-05-15 14:49:41.633546\'');
        $this->addSql('ALTER TABLE product ALTER created_at SET DEFAULT \'2024-05-15 14:49:41.633546\'');
        $this->addSql('ALTER TABLE category ALTER created_at SET DEFAULT \'2024-05-15 14:49:41.633546\'');
    }
}
