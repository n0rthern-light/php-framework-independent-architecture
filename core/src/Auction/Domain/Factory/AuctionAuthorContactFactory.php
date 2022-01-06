<?php

namespace Core\Auction\Domain\Factory;

use Core\Auction\Domain\Entity\AuctionAuthorContact;
use Core\Shared\Domain\Factory\FromAssocFactoryInterface;
use Core\Shared\Domain\ValueObject\Contact;
use Core\Shared\Domain\ValueObject\Email;
use Core\Shared\Domain\ValueObject\Phone;

class AuctionAuthorContactFactory implements FromAssocFactoryInterface
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