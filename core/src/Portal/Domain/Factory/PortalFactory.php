<?php

namespace Core\Portal\Domain\Factory;

use Core\Portal\Domain\AggregateRoot\Portal;
use Core\Portal\Domain\Collection\PortalCollection;
use Core\Portal\Domain\ValueObject\PortalName;
use Core\Portal\Domain\ValueObject\PortalUrl;
use Core\Shared\Domain\Factory\AbstractFromAssocCollectionFactory;

class PortalFactory extends AbstractFromAssocCollectionFactory
{
    public function fromAssoc(array $assocArray): Portal
    {
        $portal = new Portal();

        $portal->setId($assocArray['id']);
        $portal->setName(new PortalName($assocArray['name']));
        $portal->setUrl(new PortalUrl($assocArray['url']));

        return $portal;
    }

    protected function getCollectionClass(): string
    {
        return PortalCollection::class;
    }
}