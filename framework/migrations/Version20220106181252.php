<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106181252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create portal_place table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE portal_place (
                id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
                portal_id INT(11) UNSIGNED NOT NULL,
                name VARCHAR(64) NOT NULL,
                url VARCHAR(2048) NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (portal_id) REFERENCES portal(id)
                    ON DELETE cascade
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE portal_place');
    }
}
