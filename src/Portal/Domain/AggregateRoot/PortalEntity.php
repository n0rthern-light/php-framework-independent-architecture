<?php

namespace Core\Portal\Domain\AggregateRoot;

use Core\Shared\Domain\Entity\Entity;

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