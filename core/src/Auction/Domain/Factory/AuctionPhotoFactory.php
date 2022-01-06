<?php

namespace Core\Auction\Domain\Factory;

use Core\Auction\Domain\Collection\AuctionPhotoCollection;
use Core\Auction\Domain\Entity\AuctionPhoto;
use Core\Shared\Domain\Factory\AbstractFromAssocCollectionFactory;
use Core\Shared\Domain\ValueObject\PhotoUrl;

class AuctionPhotoFactory extends AbstractFromAssocCollectionFactory
{
    public function fromAssoc(array $assocArray): AuctionPhoto
    {
        $auctionPhoto = new AuctionPhoto();

        $auctionPhoto->setId($assocArray['id']);
        $auctionPhoto->setAuctionId($assocArray['auction_id']);
        $auctionPhoto->setUrl(new PhotoUrl($assocArray['url']));

        return $auctionPhoto;
    }

    protected function getCollectionClass(): string
    {
        return AuctionPhotoCollection::class;
    }
}