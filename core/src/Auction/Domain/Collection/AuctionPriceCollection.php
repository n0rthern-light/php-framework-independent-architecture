<?php

namespace Core\Auction\Domain\Collection;

use Core\Auction\Domain\Entity\AuctionPrice;
use Core\Shared\Domain\Collection\Collection;

class AuctionPriceCollection extends Collection
{
    protected function getCollectionItemType(): string
    {
        return AuctionPrice::class;
    }
}