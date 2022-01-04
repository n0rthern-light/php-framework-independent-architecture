<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Auction\Domain\Collection\AuctionCollection;
use Core\Auction\Domain\Repository\AuctionRepositoryInterface;
use Core\Auction\Domain\ValueObject\AuctionHash;
use Core\Shared\Domain\Criteria\PaginationCriteria;
use Framework\Auction\Infrastructure\Factory\AuctionFactory;
use Doctrine\DBAL\Connection;

class DbalAuctionRepository implements AuctionRepositoryInterface
{
    private Connection $connection;
    private AuctionFactory $auctionFactory;

    public function __construct(Connection $connection, AuctionFactory $auctionFactory)
    {
        $this->connection = $connection;
        $this->auctionFactory = $auctionFactory;
    }

    public function save(Auction $auction): void
    {
        if (!$auction->getId()) {
            $this->insert($auction);
            return;
        }

        $this->update($auction);
    }

    public function findById(int $id): ?Auction
    {
        // TODO: Implement findById() method.
    }

    public function findByHash(AuctionHash $auctionHash): ?Auction
    {
        // TODO: Implement findByHash() method.
    }

    public function fetchAll(?PaginationCriteria $paginationCriteria = null): AuctionCollection
    {
        // TODO: Implement all() method.
    }

    private function insert(Auction $auction): void
    {
        dd('inserting');
    }

    private function update(Auction $auction): void
    {
        dd('updating');
    }
}