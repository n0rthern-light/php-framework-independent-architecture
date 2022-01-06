<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104225503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create auction_price table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE auction_price (
                id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
                auction_id INT(11) UNSIGNED NOT NULL,
                price INT(11) UNSIGNED NOT NULL,
                currency INT(4) UNSIGNED NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (auction_id) REFERENCES auction(id)
                    ON DELETE cascade
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE auction_price;');
    }
}
