<?php

namespace Core\Auction\Domain\Factory;

use Core\Auction\Domain\Entity\AuctionAuthor;
use Core\Shared\Domain\Factory\FromAssocFactoryInterface;

class AuctionAuthorFactory implements FromAssocFactoryInterface
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