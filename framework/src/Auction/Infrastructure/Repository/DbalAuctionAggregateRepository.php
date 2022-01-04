<?php

namespace Framework\Auction\Infrastructure\Repository;

use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Auction\Domain\Collection\AuctionCollection;
use Core\Auction\Domain\Repository\AuctionAggregateRepositoryInterface;
use Core\Auction\Domain\Repository\AuctionRepositoryInterface;
use Core\Auction\Domain\ValueObject\AuctionHash;
use Core\Shared\Domain\Criteria\PaginationCriteria;
use Doctrine\DBAL\Connection;

class DbalAuctionAggregateRepository implements AuctionAggregateRepositoryInterface
{
    private Connection $connection;
    private AuctionRepositoryInterface $auctionRepository;

    public function __construct(
        Connection $connection,
        AuctionRepositoryInterface $auctionRepository
    )
    {
        $this->connection = $connection;
        $this->auctionRepository = $auctionRepository;
    }

    public function save(Auction $auction): void
    {
        $this->connection->beginTransaction();

        try {
            $this->auctionRepository->save($auction);


            $this->connection->commit();
        } catch (\Throwable $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
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
}