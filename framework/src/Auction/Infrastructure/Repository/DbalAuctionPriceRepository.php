<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Entity\AuctionPrice;
use Core\Auction\Domain\Repository\AuctionPriceRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Auction\Infrastructure\Factory\AuctionPriceFactory;

class DbalAuctionPriceRepository implements AuctionPriceRepositoryInterface
{
    private Connection $connection;
    private AuctionPriceFactory $auctionPriceFactory;

    public function __construct(Connection $connection, AuctionPriceFactory $auctionPriceFactory)
    {
        $this->connection = $connection;
        $this->auctionPriceFactory = $auctionPriceFactory;
    }

    public function save(AuctionPrice $auctionPrice): void
    {
        if (!$auctionPrice->getId()) {
            $this->insert($auctionPrice);
            return;
        }

        $this->update($auctionPrice);
    }

    private function insert(AuctionPrice $auctionPrice): void
    {
        $sql = '
            INSERT INTO auction_price (auction_id, price, currency)
            VALUES (
                :auctionId,
                :price,
                :currency
            );
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->executeStatement([
            'auctionId' => $auctionPrice->getAuctionId(),
            'price' => (int)$auctionPrice->getPrice()->getAmount() * 100.00,
            'currency' => $auctionPrice->getPrice()->getCurrency()->getValue(),
        ]);

        /** @var int $lastInsertId */
        $lastInsertId = $this->connection->lastInsertId();
        $auctionPrice->setId($lastInsertId);
    }

    private function update(AuctionPrice $auctionPrice): void
    {
        $sql = '
            UPDATE auction_price
            SET
                auction_id = :auctionId,
                price = :price,
                currency = :currency
            WHERE
                id = :id
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->executeStatement([
            'id' => $auctionPrice->getId(),
            'auctionId' => $auctionPrice->getAuctionId(),
            'price' => (int) $auctionPrice->getPrice()->getAmount() * 100.00,
            'currency' => $auctionPrice->getPrice()->getCurrency()->getValue(),
        ]);
    }

    public function findOneByAuctionId(int $auctionId): ?AuctionPrice
    {
        $sql = 'SELECT * FROM auction_price WHERE auction_id = :auctionId';

        $row = $this->connection->fetchAssociative($sql, ['auctionId' => $auctionId]);

        if (!$row) {
            return null;
        }

        return $this->auctionPriceFactory->fromAssoc($row);
    }
}