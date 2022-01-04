<?php

namespace Core\Auction\Application\Factory;

use Core\Auction\Application\Dto\CreateAuctionDto;
use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Auction\Domain\Entity\AuctionPrice;
use Core\Auction\Domain\ValueObject\AuctionHash;
use Core\Auction\Domain\ValueObject\AuctionName;
use Core\Auction\Domain\ValueObject\AuctionUrl;
use Core\Shared\Domain\Enum\Currency;
use Core\Shared\Domain\ValueObject\Money;

class AuctionFactory
{
    public function createFromDto(CreateAuctionDto $createAuctionDto): Auction
    {
        $auction = new Auction();
        $auction->setName(new AuctionName($createAuctionDto->getName()));
        $auction->setUrl(new AuctionUrl($createAuctionDto->getUrl()));

        // todo calculate real hash
        $auction->setHash(new AuctionHash(hash('sha256', random_bytes(16))));

        return $auction;
    }

    private function getPrice(string $price)
    {
        $auctionPrice = new AuctionPrice();
        $amount = preg_replace('/[^0-9,.]/', '', $price);
        $auctionPrice->setPrice(new Money(1231, Currency::PLN()));

        return $auctionPrice;
    }
}