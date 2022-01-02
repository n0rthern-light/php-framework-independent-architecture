<?php

namespace Core\Auction\Domain\AggregateRoot;

use Core\Shared\Domain\Entity\Entity;

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