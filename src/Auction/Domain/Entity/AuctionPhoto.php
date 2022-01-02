<?php

namespace Scraper\Auction\Domain\Entity;

use Scraper\Auction\Domain\AggregateRoot\AuctionEntity;
use Scraper\Shared\Domain\ValueObject\PhotoUrl;

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
