<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Entity\AuctionAuthor;
use Core\Auction\Domain\Repository\AuctionAuthorRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Auction\Infrastructure\Factory\AuctionAuthorFactory;

class DbalAuctionAuthorRepository implements AuctionAuthorRepositoryInterface
{
    private Connection $connection;
    private AuctionAuthorFactory $auctionAuthorFactory;

    public function __construct(Connection $connection, AuctionAuthorFactory $auctionAuthorFactory)
    {
        $this->connection = $connection;
        $this->auctionAuthorFactory = $auctionAuthorFactory;
    }

    public function save(AuctionAuthor $auctionAuthor): void
    {
        if (!$auctionAuthor->getId()) {
            $this->insert($auctionAuthor);
            return;
        }

        $this->update($auctionAuthor);
    }

    private function insert(AuctionAuthor $auctionAuthor): void
    {
        $sql = '
            INSERT INTO auction_author (auction_id, first_name, last_name, company_name)
            VALUES (
                :auctionId,
                :firstName,
                :lastName,
                :companyName
            );
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->executeStatement([
            'auctionId' => $auctionAuthor->getAuctionId(),
            'firstName' => $auctionAuthor->getFirstName(),
            'lastName' => $auctionAuthor->getLastName(),
            'companyName' => $auctionAuthor->getCompanyName(),
        ]);

        /** @var int $lastInsertId */
        $lastInsertId = $this->connection->lastInsertId();
        $auctionAuthor->setId($lastInsertId);
    }

    private function update(AuctionAuthor $auctionAuthor): void
    {
        $sql = '
            UPDATE auction_author
            SET
                auction_id = :auctionId,
                first_name = :firstName,
                last_name = :lastName,
                company_name = :companyName,
            WHERE
                id = :id
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->executeStatement([
            'id' => $auctionAuthor->getId(),
            'auctionId' => $auctionAuthor->getAuctionId(),
            'firstName' => $auctionAuthor->getFirstName(),
            'lastName' => $auctionAuthor->getLastName(),
            'companyName' => $auctionAuthor->getCompanyName(),
        ]);
    }

    public function findOneByAuctionId(int $auctionId): ?AuctionAuthor
    {
        $sql = '
            SELECT * FROM auction_author WHERE auction_id = :auctionId
        ';

        $row = $this->connection->fetchAssociative($sql, ['auctionId' => $auctionId]);

        if (!$row) {
            return null;
        }

        return $this->auctionAuthorFactory->fromAssoc($row);
    }
}