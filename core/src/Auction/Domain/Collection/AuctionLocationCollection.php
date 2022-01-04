<?php

namespace Core\Auction\Domain\Collection;

use Core\Auction\Domain\Entity\AuctionLocation;
use Core\Shared\Domain\Collection\Collection;

class AuctionLocationCollection extends Collection
{
    protected function getCollectionItemType(): string
    {
        return AuctionLocation::class;
    }
}