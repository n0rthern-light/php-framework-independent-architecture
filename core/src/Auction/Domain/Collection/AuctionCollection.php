<?php

namespace Core\Auction\Domain\Collection;

use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Shared\Domain\Collection\Collection;

class AuctionCollection extends Collection
{
    protected function getCollectionItemType(): string
    {
        return Auction::class;
    }
}