<?php

namespace Scraper\Portal\Domain\AggregateRoot;

use Scraper\Portal\Domain\ValueObject\PortalName;
use Scraper\Shared\Domain\Entity\Entity;

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