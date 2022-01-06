<?php

namespace Core\Auction\Domain\Repository;

use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Auction\Domain\Collection\AuctionCollection;
use Core\Auction\Domain\ValueObject\AuctionHash;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface AuctionAggregateRepositoryInterface
{
    public function save(Auction $auction): void;

    public function findById(int $id): ?Auction;

    public function fetchAll(?PaginationCriteria $paginationCriteria = null): AuctionCollection;
    public function fetchTotalCount(): int;
}