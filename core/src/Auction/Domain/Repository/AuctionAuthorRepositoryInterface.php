<?php

namespace Core\Auction\Domain\Repository;

use Core\Auction\Domain\Collection\AuctionAuthorCollection;
use Core\Auction\Domain\Entity\AuctionAuthor;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface AuctionAuthorRepositoryInterface
{
    public function save(AuctionAuthor $auctionAuthor): void;
    public function findOneByAuctionId(int $auctionId): ?AuctionAuthor;
}