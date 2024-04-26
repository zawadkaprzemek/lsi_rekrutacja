<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240425225451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX locale_idx ON export');
        $this->addSql('ALTER TABLE export CHANGE locale place VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX place_idx ON export (place)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX place_idx ON export');
        $this->addSql('ALTER TABLE export CHANGE place locale VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX locale_idx ON export (locale)');
    }
}
