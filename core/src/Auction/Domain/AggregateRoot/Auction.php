<?php

namespace Core\Auction\Domain\AggregateRoot;

use Core\Auction\Domain\Collection\AuctionPhotoCollection;
use Core\Auction\Domain\Entity\AuctionAuthor;
use Core\Auction\Domain\Entity\AuctionLocation;
use Core\Auction\Domain\Entity\AuctionPrice;
use Core\Auction\Domain\ValueObject\AuctionHash;
use Core\Auction\Domain\ValueObject\AuctionName;
use Core\Auction\Domain\ValueObject\AuctionUrl;
use Core\Shared\Domain\Entity\Entity;

class Auction extends Entity
{
    private AuctionName $name;
    private AuctionUrl $url;
    private AuctionHash $hash;
    private AuctionPrice $price;
    private AuctionPhotoCollection $photoCollection;
    private AuctionAuthor $author;
    private AuctionLocation $location;

    public function getName(): AuctionName
    {
        return $this->name;
    }

    public function setName(AuctionName $name): void
    {
        $this->name = $name;
    }

    public function getUrl(): AuctionUrl
    {
        return $this->url;
    }

    public function setUrl(AuctionUrl $url): void
    {
        $this->url = $url;
    }

    public function getHash(): AuctionHash
    {
        return $this->hash;
    }

    public function setHash(AuctionHash $hash): void
    {
        $this->hash = $hash;
    }

    public function getPrice(): AuctionPrice
    {
        return $this->price;
    }

    public function setPrice(AuctionPrice $price): void
    {
        $this->price = $price;
    }

    public function getPhotoCollection(): AuctionPhotoCollection
    {
        return $this->photoCollection;
    }

    public function setPhotoCollection(AuctionPhotoCollection $photoCollection): void
    {
        $this->photoCollection = $photoCollection;
    }

    public function getAuthor(): AuctionAuthor
    {
        return $this->author;
    }

    public function setAuthor(AuctionAuthor $author): void
    {
        $this->author = $author;
    }

    public function getLocation(): AuctionLocation
    {
        return $this->location;
    }

    public function setLocation(AuctionLocation $location): void
    {
        $this->location = $location;
    }
}