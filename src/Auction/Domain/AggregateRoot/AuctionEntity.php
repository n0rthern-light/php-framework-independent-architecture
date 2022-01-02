<?php

namespace Scraper\Auction\Domain\AggregateRoot;

use Scraper\Shared\Domain\Entity\Entity;

class AuctionEntity extends Entity
{
    protected int $auctionId;

    public function getAuctionId(): int
    {
        return $this->auctionId;
    }

    public function setAuctionId(int $auctionId): void
    {
        $this->auctionId = $auctionId;
    }
}