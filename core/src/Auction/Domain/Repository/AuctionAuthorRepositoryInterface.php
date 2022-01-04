<?php

namespace Core\Auction\Domain\Repository;

use Core\Auction\Domain\Collection\AuctionAuthorContactCollection;
use Core\Auction\Domain\Entity\AuctionAuthor;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface AuctionAuthorRepositoryInterface
{
    public function save(AuctionAuthor $auctionAuthor): void;

    public function findById(int $id): ?AuctionAuthor;

    public function fetchAll(?PaginationCriteria $paginationCriteria = null): AuctionAuthorContactCollection;
}