<?php

namespace Scraper\Auction\Domain\Entity;

use Scraper\Auction\Domain\AggregateRoot\AuctionEntity;
use Scraper\Shared\Domain\ValueObject\Location;

class AuctionLocation extends AuctionEntity
{
    private Location $location;

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }
}
