<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106180545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create portal table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE portal (
                id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(64) NOT NULL,
                url VARCHAR(256) NOT NULL,
                PRIMARY KEY (id)
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE portal');
    }
}
