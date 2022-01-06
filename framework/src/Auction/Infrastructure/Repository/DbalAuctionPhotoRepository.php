<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Collection\AuctionPhotoCollection;
use Core\Auction\Domain\Entity\AuctionPhoto;
use Core\Auction\Domain\Factory\AuctionPhotoFactory;
use Core\Auction\Domain\Repository\AuctionPhotoRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Shared\Infrastructure\Dbal\DbalEntityManager;

class DbalAuctionPhotoRepository implements AuctionPhotoRepositoryInterface
{
    private const TABLE_NAME = 'auction_photo';

    private Connection $connection;
    private AuctionPhotoFactory $auctionPhotoFactory;

    private DbalEntityManager $dbalEntityManager;

    public function __construct(Connection $connection, AuctionPhotoFactory $auctionPhotoFactory)
    {
        $this->connection = $connection;
        $this->auctionPhotoFactory = $auctionPhotoFactory;

        $this->dbalEntityManager = new DbalEntityManager($connection, self::TABLE_NAME);
    }

    public function save(AuctionPhoto $auctionPhoto): void
    {
        $this->dbalEntityManager->takeCareOf($auctionPhoto);
        $this->dbalEntityManager->save([
            'auction_id' => $auctionPhoto->getAuctionId(),
            'url' => $auctionPhoto->getUrl()->getValue(),
        ]);
    }

    public function findAllByAuctionId(int $auctionId): AuctionPhotoCollection
    {
        $sql = 'SELECT * FROM auction_photo WHERE auction_id = :auctionId';

        $rows = $this->connection->fetchAllAssociative($sql, ['auctionId' => $auctionId]);

        return $this->auctionPhotoFactory->fromAssocCollection($rows);
    }
}