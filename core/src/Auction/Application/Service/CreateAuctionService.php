<?php

namespace Core\Auction\Application\Service;

use Core\Auction\Application\Dto\CreateAuctionDto;
use Core\Auction\Application\Factory\AuctionFactory;
use Core\Auction\Domain\Repository\AuctionAggregateRepositoryInterface;

class CreateAuctionService
{
    private AuctionAggregateRepositoryInterface $auctionAggregateRepository;
    private AuctionFactory $auctionFactory;

    public function __construct(AuctionAggregateRepositoryInterface $auctionAggregateRepository, AuctionFactory $auctionFactory)
    {
        $this->auctionAggregateRepository = $auctionAggregateRepository;
        $this->auctionFactory = $auctionFactory;
    }

    public function execute(CreateAuctionDto $createAuctionDto): void
    {
        $auction = $this->auctionFactory->createFromDto($createAuctionDto);
        $this->auctionAggregateRepository->save($auction);
    }
}