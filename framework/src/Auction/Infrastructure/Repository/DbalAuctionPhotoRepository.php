<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Collection\AuctionPhotoCollection;
use Core\Auction\Domain\Entity\AuctionPhoto;
use Core\Auction\Domain\Factory\AuctionPhotoFactory;
use Core\Auction\Domain\Repository\AuctionPhotoRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Shared\Infrastructure\Dbal\DbalEntityManager;
use Framework\Shared\Infrastructure\Dbal\DbalQueryManager;

class DbalAuctionPhotoRepository implements AuctionPhotoRepositoryInterface
{
    private const TABLE_NAME = 'auction_photo';

    private Connection $connection;
    private AuctionPhotoFactory $auctionPhotoFactory;

    private DbalEntityManager $dbalEntityManager;
    private DbalQueryManager $dbalQueryManager;

    public function __construct(Connection $connection, AuctionPhotoFactory $auctionPhotoFactory)
    {
        $this->connection = $connection;
        $this->auctionPhotoFactory = $auctionPhotoFactory;

        $this->dbalEntityManager = new DbalEntityManager($connection, self::TABLE_NAME);
        $this->dbalQueryManager = new DbalQueryManager($connection, self::TABLE_NAME);
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
        $rows = $this->dbalQueryManager->selectAllByCriteria(['auction_id' => $auctionId]);

        return $this->auctionPhotoFactory->fromAssocCollection($rows);
    }
}