<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Entity\AuctionLocation;
use Core\Auction\Domain\Factory\AuctionLocationFactory;
use Core\Auction\Domain\Repository\AuctionLocationRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Shared\Infrastructure\Dbal\DbalEntityManager;
use Framework\Shared\Infrastructure\Dbal\DbalQueryManager;

class DbalAuctionLocationRepository implements AuctionLocationRepositoryInterface
{
    private const TABLE_NAME = 'auction_location';

    private Connection $connection;
    private AuctionLocationFactory $auctionLocationFactory;

    private DbalEntityManager $dbalEntityManager;
    private DbalQueryManager $dbalQueryManager;

    public function __construct(Connection $connection, AuctionLocationFactory $auctionLocationFactory)
    {
        $this->connection = $connection;
        $this->auctionLocationFactory = $auctionLocationFactory;

        $this->dbalEntityManager = new DbalEntityManager($connection, self::TABLE_NAME);
        $this->dbalQueryManager = new DbalQueryManager($connection, self::TABLE_NAME);
    }

    public function save(AuctionLocation $auctionLocation): void
    {
        $this->dbalEntityManager->takeCareOf($auctionLocation);
        $this->dbalEntityManager->save([
            'auction_id' => $auctionLocation->getAuctionId(),
            'city' => $auctionLocation->getLocation()->getCity(),
            'country' => $auctionLocation->getLocation()->getCountry(),
            'zip' => $auctionLocation->getLocation()->getZip(),
        ]);
    }

    public function findOneByAuctionId(int $auctionId): ?AuctionLocation
    {
        $row = $this->dbalQueryManager->selectOneByCriteria(['auction_id' => $auctionId]);

        return $row ? $this->auctionLocationFactory->fromAssoc($row) : null;
    }
}