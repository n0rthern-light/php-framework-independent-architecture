<?php

namespace Core\Auction\Domain\Entity;

use Core\Auction\Domain\AggregateRoot\AuctionEntity;

class AuctionAuthor extends AuctionEntity
{
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $companyName = null;
    private AuctionAuthorContact $contact;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): void
    {
        $this->companyName = $companyName;
    }

    public function getContact(): AuctionAuthorContact
    {
        return $this->contact;
    }

    public function setContact(AuctionAuthorContact $contact): void
    {
        $this->contact = $contact;
    }
}