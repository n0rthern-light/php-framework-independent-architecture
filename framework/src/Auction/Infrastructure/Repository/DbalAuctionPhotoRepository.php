<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Collection\AuctionPhotoCollection;
use Core\Auction\Domain\Entity\AuctionPhoto;
use Core\Auction\Domain\Repository\AuctionPhotoRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Auction\Infrastructure\Factory\AuctionPhotoFactory;

class DbalAuctionPhotoRepository implements AuctionPhotoRepositoryInterface
{
    private Connection $connection;
    private AuctionPhotoFactory $auctionPhotoFactory;

    public function __construct(Connection $connection, AuctionPhotoFactory $auctionPhotoFactory)
    {
        $this->connection = $connection;
        $this->auctionPhotoFactory = $auctionPhotoFactory;
    }

    public function save(AuctionPhoto $auctionPhoto): void
    {
        if (!$auctionPhoto->getId()) {
            $this->insert($auctionPhoto);
            return;
        }

        $this->update($auctionPhoto);
    }

    private function insert(AuctionPhoto $auctionPhoto): void
    {
        $sql = '
            INSERT INTO auction_photo (auction_id, url)
            VALUES (
                :auctionId,
                :url
            );
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->executeStatement([
            'auctionId' => $auctionPhoto->getAuctionId(),
            'url' => $auctionPhoto->getUrl()->getValue(),
        ]);

        /** @var int $lastInsertId */
        $lastInsertId = $this->connection->lastInsertId();
        $auctionPhoto->setId($lastInsertId);
    }

    private function update(AuctionPhoto $auctionPhoto): void
    {
        $sql = '
            UPDATE auction_photo
            SET
                auction_id = :auctionId,
                url = :url
            WHERE
                id = :id
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->executeStatement([
            'id' => $auctionPhoto->getId(),
            'auctionId' => $auctionPhoto->getAuctionId(),
            'url' => $auctionPhoto->getUrl()->getValue(),
        ]);
    }

    public function findAllByAuctionId(int $auctionId): AuctionPhotoCollection
    {
        $sql = 'SELECT * FROM auction_photo WHERE auction_id = :auctionId';

        $rows = $this->connection->fetchAllAssociative($sql, ['auctionId' => $auctionId]);

        return $this->auctionPhotoFactory->collectionFromAssocRows($rows);
    }
}