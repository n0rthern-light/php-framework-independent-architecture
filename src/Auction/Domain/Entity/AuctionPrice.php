<?php

namespace Scraper\Auction\Domain\Entity;

use Scraper\Auction\Domain\AggregateRoot\AuctionEntity;
use Scraper\Shared\Domain\ValueObject\Money;

class AuctionPrice extends AuctionEntity
{
    private Money $price;

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function setPrice(Money $price): void
    {
        $this->price = $price;
    }
}
