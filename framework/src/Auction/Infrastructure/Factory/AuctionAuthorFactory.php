<?php

namespace Framework\Auction\Infrastructure\Factory;

use Core\Auction\Domain\Entity\AuctionAuthor;

class AuctionAuthorFactory
{
    public function fromAssoc(array $assocArray): AuctionAuthor
    {
        $auctionAuthor = new AuctionAuthor();

        $auctionAuthor->setId($assocArray['id']);
        $auctionAuthor->setAuctionId($assocArray['auction_id']);
        $auctionAuthor->setFirstName($assocArray['first_name']);
        $auctionAuthor->setLastName($assocArray['last_name']);
        $auctionAuthor->setCompanyName($assocArray['company_name']);

        return $auctionAuthor;
    }
}