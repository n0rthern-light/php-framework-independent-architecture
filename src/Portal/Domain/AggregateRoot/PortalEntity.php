<?php

namespace Scraper\Portal\Domain\AggregateRoot;

use Scraper\Shared\Domain\Entity\Entity;

class PortalEntity extends Entity
{
    protected int $portalId;

    public function getPortalId(): int
    {
        return $this->portalId;
    }

    public function setPortalId(int $portalId): void
    {
        $this->portalId = $portalId;
    }
}