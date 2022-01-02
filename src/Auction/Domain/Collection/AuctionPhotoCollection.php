<?php

namespace Scraper\Auction\Domain\Collection;

use Scraper\Auction\Domain\Entity\AuctionPhoto;
use Scraper\Shared\Domain\Collection\Collection;

class AuctionPhotoCollection extends Collection
{
    protected function getCollectionItemType(): string
    {
        return AuctionPhoto::class;
    }
}