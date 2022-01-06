<?php

namespace Framework\Auction\Infrastructure\Factory;

use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Auction\Domain\ValueObject\AuctionHash;
use Core\Auction\Domain\ValueObject\AuctionName;
use Core\Auction\Domain\ValueObject\AuctionUrl;

class AuctionFactory
{
    public function fromAssoc(array $assocArray): Auction
    {
        $auction = new Auction();

        $auction->setId($assocArray['id']);
        $auction->setHash(new AuctionHash($assocArray['hash']));
        $auction->setName(new AuctionName($assocArray['name']));
        $auction->setUrl(new AuctionUrl($assocArray['url']));

        return $auction;
    }
}