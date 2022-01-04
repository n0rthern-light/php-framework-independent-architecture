<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104222029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create auction table - aggregate root';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE auction
            (
                id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
                hash VARCHAR(256) NOT NULL,
                name VARCHAR(256) NOT NULL,
                url VARCHAR(2048) NOT NULL,
                PRIMARY KEY(id)
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('
            DROP TABLE auction;
        ');
    }
}
