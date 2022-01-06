<?php

namespace Core\Auction\Application\Factory;

use Core\Auction\Application\Dto\CreateAuctionDto;
use Core\Auction\Domain\AggregateRoot\Auction;
use Core\Auction\Domain\Collection\AuctionPhotoCollection;
use Core\Auction\Domain\Entity\AuctionAuthor;
use Core\Auction\Domain\Entity\AuctionAuthorContact;
use Core\Auction\Domain\Entity\AuctionLocation;
use Core\Auction\Domain\Entity\AuctionPhoto;
use Core\Auction\Domain\Entity\AuctionPrice;
use Core\Auction\Domain\ValueObject\AuctionHash;
use Core\Auction\Domain\ValueObject\AuctionName;
use Core\Auction\Domain\ValueObject\AuctionUrl;
use Core\Shared\Domain\Enum\Currency;
use Core\Shared\Domain\ValueObject\Contact;
use Core\Shared\Domain\ValueObject\Email;
use Core\Shared\Domain\ValueObject\Location;
use Core\Shared\Domain\ValueObject\Money;
use Core\Shared\Domain\ValueObject\Phone;
use Core\Shared\Domain\ValueObject\PhotoUrl;

class AuctionFactory
{
    public function createFromDto(CreateAuctionDto $createAuctionDto): Auction
    {
        $auction = new Auction();
        $auction->setName(new AuctionName($createAuctionDto->getName()));
        $auction->setUrl(new AuctionUrl($createAuctionDto->getUrl()));

        $auction->setHash(new AuctionHash(hash('sha256', random_bytes(16))));

        $author = new AuctionAuthor();
        $parts = explode(' ', $createAuctionDto->getAuthor());

        if (isset($parts[0])) {
            $author->setFirstName($parts[0]);
        }

        if (isset($parts[1])) {
            $author->setFirstName($parts[1]);
        }

        $authorContact = new AuctionAuthorContact();
        $authorContact->setContact(
            new Contact(
                new Phone($createAuctionDto->getPhone()),
                new Email($createAuctionDto->getEmail())
            )
        );

        $author->setContact($authorContact);
        $auction->setAuthor($author);

        $photoCollection = new AuctionPhotoCollection();

        foreach($createAuctionDto->getPhotos() as $photoUrl) {
            $photo = new AuctionPhoto();
            $photo->setUrl(new PhotoUrl($photoUrl));
            $photoCollection->add($photo);
        }

        $auction->setPhotoCollection($photoCollection);

        $location = new AuctionLocation();
        $location->setLocation(
            new Location($createAuctionDto->getLocation(), 'Poland', null)
        );
        $auction->setLocation($location);

        $auction->setPrice($this->getPrice('43214'));

        return $auction;
    }

    private function getPrice(string $price)
    {
        $auctionPrice = new AuctionPrice();
        $amount = preg_replace('/[^0-9,.]/', '', $price);
        $auctionPrice->setPrice(new Money($amount, Currency::PLN()));

        return $auctionPrice;
    }
}