<?php

namespace Framework\Auction\Infrastructure\Factory;

use Core\Auction\Domain\Collection\AuctionPhotoCollection;
use Core\Auction\Domain\Entity\AuctionPhoto;
use Core\Shared\Domain\ValueObject\PhotoUrl;

class AuctionPhotoFactory
{
    public function collectionFromAssocRows(array $assocRows): AuctionPhotoCollection
    {
        $collection = new AuctionPhotoCollection();
        foreach($assocRows as $row) {
            $collection->add($this->fromAssoc($row));
        }
        return $collection;
    }

    public function fromAssoc(array $assocArray): AuctionPhoto
    {
        $auctionPhoto = new AuctionPhoto();

        $auctionPhoto->setId($assocArray['id']);
        $auctionPhoto->setAuctionId($assocArray['auction_id']);
        $auctionPhoto->setUrl(new PhotoUrl($assocArray['url']));

        return $auctionPhoto;
    }
}