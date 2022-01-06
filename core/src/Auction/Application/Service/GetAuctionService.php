<?php

namespace Core\Auction\Application\Service;

use Core\Auction\Domain\Collection\AuctionCollection;
use Core\Auction\Domain\Repository\AuctionAggregateRepositoryInterface;
use Core\Shared\Domain\Criteria\PaginationCriteria;

class GetAuctionService
{
    private AuctionAggregateRepositoryInterface $auctionAggregateRepository;

    public function __construct(AuctionAggregateRepositoryInterface $auctionAggregateRepository)
    {
        $this->auctionAggregateRepository = $auctionAggregateRepository;
    }

    public function getList(?PaginationCriteria $paginationCriteria = null): AuctionCollection
    {
        return $this->auctionAggregateRepository->fetchAll($paginationCriteria);
    }

    public function getTotalCount(): int
    {
        return $this->auctionAggregateRepository->fetchTotalCount();
    }
}