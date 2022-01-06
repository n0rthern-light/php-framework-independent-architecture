<?php

namespace Core\Auction\Domain\Factory;

use Core\Auction\Domain\Entity\AuctionLocation;
use Core\Shared\Domain\Factory\FromAssocFactoryInterface;
use Core\Shared\Domain\ValueObject\Location;

class AuctionLocationFactory implements FromAssocFactoryInterface
{
    public function fromAssoc(array $assocArray): AuctionLocation
    {
        $auctionLocation = new AuctionLocation();

        $auctionLocation->setId($assocArray['id']);
        $auctionLocation->setAuctionId($assocArray['auction_id']);
        $auctionLocation->setLocation(new Location($assocArray['city'], $assocArray['country'], $assocArray['zip']));

        return $auctionLocation;
    }
}