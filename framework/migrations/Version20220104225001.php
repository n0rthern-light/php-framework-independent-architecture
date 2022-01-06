<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104225001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create auction_photo table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE auction_photo (
                id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
                auction_id INT(11) UNSIGNED NOT NULL,
                url VARCHAR(2048) NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (auction_id) REFERENCES auction(id)
                    ON DELETE cascade
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE auction_photo;');
    }
}
