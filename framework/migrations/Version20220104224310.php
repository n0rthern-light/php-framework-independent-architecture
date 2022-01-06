<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104224310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create auction_location table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE auction_location (
                id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
                auction_id INT(11) UNSIGNED NOT NULL,
                city VARCHAR(256) NOT NULL,
                country VARCHAR(256) NOT NULL,
                zip VARCHAR(48),
                PRIMARY KEY (id),
                FOREIGN KEY (auction_id) REFERENCES auction(id)
                    ON DELETE cascade
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE auction_location');
    }
}
