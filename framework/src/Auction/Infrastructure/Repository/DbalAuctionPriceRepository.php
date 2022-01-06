<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\Entity\AuctionPrice;
use Core\Auction\Domain\Factory\AuctionPriceFactory;
use Core\Auction\Domain\Repository\AuctionPriceRepositoryInterface;
use Doctrine\DBAL\Connection;
use Framework\Shared\Infrastructure\Dbal\DbalEntityManager;
use Framework\Shared\Infrastructure\Dbal\DbalQueryManager;

class DbalAuctionPriceRepository implements AuctionPriceRepositoryInterface
{
    private const TABLE_NAME = 'auction_price';

    private Connection $connection;
    private AuctionPriceFactory $auctionPriceFactory;

    private DbalEntityManager $dbalEntityManager;
    private DbalQueryManager $dbalQueryManager;

    public function __construct(Connection $connection, AuctionPriceFactory $auctionPriceFactory)
    {
        $this->connection = $connection;
        $this->auctionPriceFactory = $auctionPriceFactory;

        $this->dbalEntityManager = new DbalEntityManager($connection, self::TABLE_NAME);
        $this->dbalQueryManager = new DbalQueryManager($connection, self::TABLE_NAME);
    }

    public function save(AuctionPrice $auctionPrice): void
    {
        $this->dbalEntityManager->takeCareOf($auctionPrice);
        $this->dbalEntityManager->save([
            'auction_id' => $auctionPrice->getAuctionId(),
            'price' => (int)($auctionPrice->getPrice()->getAmount() * 100.00),
            'currency' => $auctionPrice->getPrice()->getCurrency()->getValue(),
        ]);
    }

    public function findOneByAuctionId(int $auctionId): ?AuctionPrice
    {
        $row = $this->dbalQueryManager->selectOneByCriteria(['auction_id' => $auctionId]);

        return $row ? $this->auctionPriceFactory->fromAssoc($row) : null;
    }
}