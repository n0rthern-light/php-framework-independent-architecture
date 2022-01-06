<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Auction\Domain\Collection\AuctionCollection;
use Core\Auction\Domain\Factory\AuctionFactory;
use Core\Auction\Domain\Repository\AuctionRepositoryInterface;
use Core\Shared\Domain\Criteria\PaginationCriteria;
use Doctrine\DBAL\Connection;
use Framework\Shared\Infrastructure\Dbal\DbalEntityManager;
use Framework\Shared\Infrastructure\Dbal\DbalQueryManager;

class DbalAuctionRepository implements AuctionRepositoryInterface
{
    private const TABLE_NAME = 'auction';

    private Connection $connection;
    private AuctionFactory $auctionFactory;

    private DbalEntityManager $dbalEntityManager;
    private DbalQueryManager $dbalQueryManager;

    public function __construct(Connection $connection, AuctionFactory $auctionFactory)
    {
        $this->connection = $connection;
        $this->auctionFactory = $auctionFactory;

        $this->dbalEntityManager = new DbalEntityManager($connection, self::TABLE_NAME);
        $this->dbalQueryManager = new DbalQueryManager($connection, self::TABLE_NAME);
    }

    public function save(Auction $auction): void
    {
        $this->dbalEntityManager->takeCareOf($auction);
        $this->dbalEntityManager->save([
            'hash' => $auction->getHash()->getValue(),
            'name' => $auction->getName()->getValue(),
            'url' => $auction->getUrl()->getValue(),
        ]);
    }

    public function fetchAll(?PaginationCriteria $paginationCriteria = null): AuctionCollection
    {
        $rows = $this->dbalQueryManager->selectAll($paginationCriteria);

        return $this->auctionFactory->fromAssocCollection($rows);
    }

    public function fetchTotalCount(): int
    {
        return $this->dbalQueryManager->selectCount();
    }

    public function findById(int $id): ?Auction
    {
        $row = $this->dbalQueryManager->selectOneById($id);

        return $row ? $this->auctionFactory->fromAssoc($row) : null;
    }
}