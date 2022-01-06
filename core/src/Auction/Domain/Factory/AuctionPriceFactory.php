<?php

namespace Core\Auction\Domain\Factory;

use Core\Auction\Domain\Entity\AuctionPrice;
use Core\Shared\Domain\Enum\Currency;
use Core\Shared\Domain\Factory\FromAssocFactoryInterface;
use Core\Shared\Domain\ValueObject\Money;

class AuctionPriceFactory implements FromAssocFactoryInterface
{
    public function fromAssoc(array $assocArray): AuctionPrice
    {
        $auctionPrice = new AuctionPrice();

        $auctionPrice->setId($assocArray['id']);
        $auctionPrice->setAuctionId($assocArray['auction_id']);
        $auctionPrice->setPrice(new Money($assocArray['price'] / 100.00, Currency::from((int)$assocArray['currency'])));;

        return $auctionPrice;
    }
}