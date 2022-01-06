<?php

namespace Core\Auction\Domain\Repository;

use Core\Auction\Domain\Collection\AuctionPriceCollection;
use Core\Auction\Domain\Entity\AuctionPrice;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface AuctionPriceRepositoryInterface
{
    public function save(AuctionPrice $auctionPrice): void;
    public function findOneByAuctionId(int $auctionId): ?AuctionPrice;
}