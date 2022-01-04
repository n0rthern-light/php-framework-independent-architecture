<?php

namespace Framework\Auction\Infrastructure\Factory;

use Core\Auction\Domain\AggregateRoot\Auction;

class AuctionFactory
{
    public function __construct()
    {

    }

    public function createFromPdoRow(array $row): Auction
    {
        $auction = new Auction();

        return $auction;
    }
}