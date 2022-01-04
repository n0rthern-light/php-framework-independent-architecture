<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104223417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create auction_author_contact table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE auction_author_contact (
                id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
                auction_author_id INT(11) UNSIGNED NOT NULL,
                email VARCHAR(256),
                phone VARCHAR(256),
                PRIMARY KEY (id),
                FOREIGN KEY (auction_author_id) REFERENCES auction_author(id)
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE auction_author_contact');
    }
}
