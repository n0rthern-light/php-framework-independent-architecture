<?php

namespace Core\Auction\Domain\Repository;

use Core\Auction\Domain\Collection\AuctionLocationCollection;
use Core\Auction\Domain\Entity\AuctionLocation;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface AuctionLocationRepositoryInterface
{
    public function save(AuctionLocation $auctionLocation): void;
    public function findOneByAuctionId(int $auctionId): ?AuctionLocation;
}