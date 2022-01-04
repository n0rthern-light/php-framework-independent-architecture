<?php

namespace Core\Auction\Domain\Repository;

use Core\Auction\Domain\Collection\AuctionAuthorContactCollection;
use Core\Auction\Domain\Entity\AuctionAuthorContact;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface AuctionAuthorContactRepositoryInterface
{
    public function save(AuctionAuthorContact $auctionAuthorContact): void;

    public function findById(int $id): ?AuctionAuthorContact;

    public function fetchAll(?PaginationCriteria $paginationCriteria = null): AuctionAuthorContactCollection;
}