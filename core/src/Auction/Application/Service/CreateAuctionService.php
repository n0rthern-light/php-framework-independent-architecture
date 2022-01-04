<?php

namespace Core\Auction\Application\Service;

use Core\Auction\Application\Dto\CreateAuctionDto;
use Core\Auction\Application\Factory\AuctionFactory;
use Core\Auction\Domain\Repository\AuctionRepositoryInterface;

class CreateAuctionService
{
    private AuctionRepositoryInterface $auctionRepository;
    private AuctionFactory $auctionFactory;

    public function __construct(AuctionRepositoryInterface $auctionRepository, AuctionFactory $auctionFactory)
    {
        $this->auctionRepository = $auctionRepository;
        $this->auctionFactory = $auctionFactory;
    }

    public function execute(CreateAuctionDto $createAuctionDto): void
    {
        $auction = $this->auctionFactory->createFromDto($createAuctionDto);
        $this->auctionRepository->save($auction);
    }
}