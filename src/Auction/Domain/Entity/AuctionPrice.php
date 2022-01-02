<?php

namespace Core\Auction\Domain\Entity;

use Core\Auction\Domain\AggregateRoot\AuctionEntity;
use Core\Shared\Domain\ValueObject\Money;

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
