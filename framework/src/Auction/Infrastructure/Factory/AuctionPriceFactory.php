<?php

namespace Framework\Auction\Infrastructure\Factory;

use Core\Auction\Domain\Entity\AuctionPrice;
use Core\Shared\Domain\Enum\Currency;
use Core\Shared\Domain\ValueObject\Money;

class AuctionPriceFactory
{
    public function fromAssoc(array $assocArray): AuctionPrice
    {
        $auctionPrice = new AuctionPrice();

        $auctionPrice->setId($assocArray['id']);
        $auctionPrice->setAuctionId($assocArray['auction_id']);
        $auctionPrice->setPrice(new Money($assocArray['price'], Currency::from((int)$assocArray['currency'])));;

        return $auctionPrice;
    }
}