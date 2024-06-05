<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240604151157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ALTER created_at SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE comment ADD state VARCHAR(255) DEFAULT \'submitted\' NOT NULL');
        $this->addSql('ALTER TABLE comment ALTER created_at SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE product ALTER created_at SET DEFAULT \'now()\'');
        $this->addSql("UPDATE comment SET state='published'");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP state');
        $this->addSql('ALTER TABLE comment ALTER created_at SET DEFAULT \'2024-06-04 09:57:47.409788\'');
        $this->addSql('ALTER TABLE category ALTER created_at SET DEFAULT \'2024-06-04 09:57:47.409788\'');
        $this->addSql('ALTER TABLE product ALTER created_at SET DEFAULT \'2024-06-04 09:57:47.409788\'');
    }
}
