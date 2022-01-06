<?php

namespace Core\Auction\Domain\Entity;

use Core\Shared\Domain\Entity\Entity;
use Core\Shared\Domain\ValueObject\Contact;

class AuctionAuthorContact extends Entity
{
    private int $auctionAuthorId;
    private Contact $contact;

    public function getAuctionAuthorId(): int
    {
        return $this->auctionAuthorId;
    }

    public function setAuctionAuthorId(int $auctionAuthorId): void
    {
        $this->auctionAuthorId = $auctionAuthorId;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): void
    {
        $this->contact = $contact;
    }
}
