<?php

namespace Core\Auction\Domain\Repository;

use Core\Auction\Domain\Collection\AuctionPhotoCollection;
use Core\Auction\Domain\Entity\AuctionPhoto;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface AuctionPhotoRepositoryInterface
{
    public function save(AuctionPhoto $auctionPhoto): void;
    public function findAllByAuctionId(int $auctionId): AuctionPhotoCollection;
}