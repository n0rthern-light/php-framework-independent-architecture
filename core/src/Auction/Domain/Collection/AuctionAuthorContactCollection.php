<?php

namespace Core\Auction\Domain\Collection;

use Core\Auction\Domain\Entity\AuctionAuthor;
use Core\Auction\Domain\Entity\AuctionAuthorContact;
use Core\Shared\Domain\Collection\Collection;

class AuctionAuthorContactCollection extends Collection
{
    protected function getCollectionItemType(): string
    {
        return AuctionAuthorContact::class;
    }
}