<?php

namespace Scraper\Auction\Domain\Entity;

use Scraper\Auction\Domain\AggregateRoot\AuctionEntity;

class AuctionAuthor extends AuctionEntity
{
    private ?string $firstName;
    private ?string $lastName;
    private ?string $companyName;

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
}