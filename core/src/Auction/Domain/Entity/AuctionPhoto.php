<?php

namespace Core\Auction\Domain\Entity;

use Core\Auction\Domain\AggregateRoot\AuctionEntity;
use Core\Shared\Domain\ValueObject\PhotoUrl;

class AuctionPhoto extends AuctionEntity
{
    private PhotoUrl $url;

    public function getUrl(): PhotoUrl
    {
        return $this->url;
    }

    public function setUrl(PhotoUrl $url): void
    {
        $this->url = $url;
    }
}
