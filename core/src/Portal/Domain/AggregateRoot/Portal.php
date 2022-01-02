<?php

namespace Core\Portal\Domain\AggregateRoot;

use Core\Portal\Domain\ValueObject\PortalName;
use Core\Shared\Domain\Entity\Entity;

class Portal extends Entity
{
    private PortalName $name;

    public function getName(): PortalName
    {
        return $this->name;
    }

    public function setName(PortalName $name): void
    {
        $this->name = $name;
    }
}