<?php

namespace Core\Auction\Domain\Collection;

use Core\Auction\Domain\Entity\AuctionAuthor;
use Core\Shared\Domain\Collection\Collection;

class AuctionAuthorCollection extends Collection
{
    protected function getCollectionItemType(): string
    {
        return AuctionAuthor::class;
    }
}