<?php

namespace Framework\Auction\Infrastructure\Factory;

use Core\Auction\Domain\Entity\AuctionAuthorContact;
use Core\Shared\Domain\ValueObject\Contact;
use Core\Shared\Domain\ValueObject\Email;
use Core\Shared\Domain\ValueObject\Phone;

class AuctionAuthorContactFactory
{
    public function fromAssoc(array $assocArray): AuctionAuthorContact
    {
        $auctionAuthorContact = new AuctionAuthorContact();

        $auctionAuthorContact->setId($assocArray['id']);
        $auctionAuthorContact->setAuctionAuthorId($assocArray['auction_author_id']);
        $auctionAuthorContact->setContact(new Contact(new Phone($assocArray['phone']), new Email($assocArray['email'])));

        return $auctionAuthorContact;
    }
}