<?php

namespace Scraper\Auction\Domain\Entity;

use Scraper\Auction\Domain\AggregateRoot\AuctionEntity;
use Scraper\Shared\Domain\ValueObject\Contact;

class AuctionAuthorContact extends AuctionEntity
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
