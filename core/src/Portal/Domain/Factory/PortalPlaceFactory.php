<?php

namespace Core\Portal\Domain\Factory;

use Core\Portal\Domain\Collection\PortalPlaceCollection;
use Core\Portal\Domain\Entity\PortalPlace;
use Core\Portal\Domain\ValueObject\PortalPlaceName;
use Core\Portal\Domain\ValueObject\PortalPlaceUrl;
use Core\Shared\Domain\Factory\AbstractFromAssocCollectionFactory;

class PortalPlaceFactory extends AbstractFromAssocCollectionFactory
{
    public function fromAssoc(array $assocArray): PortalPlace
    {
        $portalPlace = new PortalPlace();

        $portalPlace->setId($assocArray['id']);
        $portalPlace->setPortalId($assocArray['portal_id']);
        $portalPlace->setName(new PortalPlaceName($assocArray['name']));
        $portalPlace->setUrl(new PortalPlaceUrl($assocArray['url']));

        return $portalPlace;
    }

    protected function getCollectionClass(): string
    {
        return PortalPlaceCollection::class;
    }
}