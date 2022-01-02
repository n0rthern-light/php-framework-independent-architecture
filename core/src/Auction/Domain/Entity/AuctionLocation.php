<?php

namespace Core\Auction\Domain\Entity;

use Core\Auction\Domain\AggregateRoot\AuctionEntity;
use Core\Shared\Domain\ValueObject\Location;

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
