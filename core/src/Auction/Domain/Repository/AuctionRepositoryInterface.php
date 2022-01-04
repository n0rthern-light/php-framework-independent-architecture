<?php

namespace Core\Auction\Domain\Repository;

use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Auction\Domain\Collection\AuctionCollection;
use Core\Auction\Domain\ValueObject\AuctionHash;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface AuctionRepositoryInterface
{
    public function save(Auction $auction): void;

    public function findById(int $id): ?Auction;
    public function findByHash(AuctionHash $auctionHash): ?Auction;

    public function fetchAll(?PaginationCriteria $paginationCriteria = null): AuctionCollection;
}