<?php

namespace Core\Auction\Domain\Repository;

use Core\Auction\Domain\Collection\AuctionLocationCollection;
use Core\Auction\Domain\Collection\AuctionPriceCollection;
use Core\Auction\Domain\Entity\AuctionLocation;
use Core\Auction\Domain\Entity\AuctionPhoto;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface AuctionPhotoRepositoryInterface
{
    public function save(AuctionPhoto $auctionPhoto): void;

    public function findById(int $id): ?AuctionPhoto;

    public function fetchAll(?PaginationCriteria $paginationCriteria = null): AuctionPriceCollection;
}