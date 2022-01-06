<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Entity\AuctionAuthorContact;
use Core\Auction\Domain\Repository\AuctionAuthorContactRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Auction\Infrastructure\Factory\AuctionAuthorContactFactory;

class DbalAuctionAuthorContactRepository implements AuctionAuthorContactRepositoryInterface
{
    private Connection $connection;
    private AuctionAuthorContactFactory $auctionAuthorContactFactory;

    public function __construct(Connection $connection, AuctionAuthorContactFactory $auctionAuthorContactFactory)
    {
        $this->connection = $connection;
        $this->auctionAuthorContactFactory = $auctionAuthorContactFactory;
    }

    public function save(AuctionAuthorContact $auctionAuthorContact): void
    {
        if (!$auctionAuthorContact->getId()) {
            $this->insert($auctionAuthorContact);
            return;
        }

        $this->update($auctionAuthorContact);
    }

    private function insert(AuctionAuthorContact $auctionAuthorContact): void
    {
        $sql = '
            INSERT INTO auction_author_contact (auction_author_id, email, phone)
            VALUES (
                :auctionAuthorId,
                :email,
                :phone
            );
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->executeStatement([
            'auctionAuthorId' => $auctionAuthorContact->getAuctionAuthorId(),
            'email' => $auctionAuthorContact->getContact()->getEmail()->getValue(),
            'phone' => $auctionAuthorContact->getContact()->getPhone()->getValue(),
        ]);

        /** @var int $lastInsertId */
        $lastInsertId = $this->connection->lastInsertId();
        $auctionAuthorContact->setId($lastInsertId);
    }

    private function update(AuctionAuthorContact $auctionAuthorContact): void
    {
        $sql = '
            UPDATE auction_author_contact
            SET
                auction_author_id = :auctionAuthorId,
                email = :email,
                phone = :phone,
            WHERE
                id = :id
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->executeStatement([
            'id' => $auctionAuthorContact->getId(),
            'auctionAuthorId' => $auctionAuthorContact->getAuctionAuthorId(),
            'email' => $auctionAuthorContact->getContact()->getEmail()->getValue(),
            'phone' => $auctionAuthorContact->getContact()->getPhone()->getValue(),
        ]);
    }

    public function findOneByAuctionAuthorId(int $auctionAuthorId): ?AuctionAuthorContact
    {
        $sql = '
            SELECT * FROM auction_author_contact WHERE auction_author_id = :auctionAuthorId
        ';

        $row = $this->connection->fetchAssociative($sql, ['auctionAuthorId' => $auctionAuthorId]);

        if (!$row) {
            return null;
        }

        return $this->auctionAuthorContactFactory->fromAssoc($row);
    }
}