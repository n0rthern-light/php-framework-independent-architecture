<?php

namespace Core\Auction\Domain\Collection;

use Core\Auction\Domain\Entity\AuctionPhoto;
use Core\Shared\Domain\Collection\Collection;

class AuctionPhotoCollection extends Collection
{
    protected function getCollectionItemType(): string
    {
        return AuctionPhoto::class;
    }
}