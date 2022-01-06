<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Entity\AuctionLocation;
use Core\Auction\Domain\Repository\AuctionLocationRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Auction\Infrastructure\Factory\AuctionLocationFactory;

class DbalAuctionLocationRepository implements AuctionLocationRepositoryInterface
{
    private Connection $connection;
    private AuctionLocationFactory $auctionLocationFactory;

    public function __construct(Connection $connection, AuctionLocationFactory $auctionLocationFactory)
    {
        $this->connection = $connection;
        $this->auctionLocationFactory = $auctionLocationFactory;
    }

    public function save(AuctionLocation $auctionLocation): void
    {
        if (!$auctionLocation->getId()) {
            $this->insert($auctionLocation);
            return;
        }

        $this->update($auctionLocation);
    }

    private function insert(AuctionLocation $auctionLocation): void
    {
        $sql = '
            INSERT INTO auction_location (auction_id, city, country, zip)
            VALUES (
                :auctionId,
                :city,
                :country,
                :zip
            );
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->executeStatement([
            'auctionId' => $auctionLocation->getAuctionId(),
            'city' => $auctionLocation->getLocation()->getCountry(),
            'country' => $auctionLocation->getLocation()->getCity(),
            'zip' => $auctionLocation->getLocation()->getZip(),
        ]);

        /** @var int $lastInsertId */
        $lastInsertId = $this->connection->lastInsertId();
        $auctionLocation->setId($lastInsertId);
    }

    private function update(AuctionLocation $auctionLocation): void
    {
        $sql = '
            UPDATE auction_location
            SET
                auction_id = :auctionId,
                city = :city,
                country = :country,
                zip = :zip,
            WHERE
                id = :id
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->executeStatement([
            'id' => $auctionLocation->getId(),
            'auctionId' => $auctionLocation->getAuctionId(),
            'city' => $auctionLocation->getLocation()->getCity(),
            'country' => $auctionLocation->getLocation()->getCountry(),
            'zip' => $auctionLocation->getLocation()->getZip(),
        ]);
    }

    public function findOneByAuctionId(int $auctionId): ?AuctionLocation
    {
        $sql = '
            SELECT * FROM auction_location WHERE auction_id = :auctionId
        ';

        $row = $this->connection->fetchAssociative($sql, ['auctionId' => $auctionId]);

        if (!$row) {
            return null;
        }

        return $this->auctionLocationFactory->fromAssoc($row);
    }
}