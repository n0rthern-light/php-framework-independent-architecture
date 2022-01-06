<?php

namespace Core\Portal\Domain\AggregateRoot;

use Core\Portal\Domain\ValueObject\PortalName;
use Core\Portal\Domain\ValueObject\PortalUrl;
use Core\Shared\Domain\Entity\Entity;

class Portal extends Entity
{
    private PortalName $name;
    private PortalUrl $url;

    public function getName(): PortalName
    {
        return $this->name;
    }

    public function setName(PortalName $name): void
    {
        $this->name = $name;
    }

    public function getUrl(): PortalUrl
    {
        return $this->url;
    }

    public function setUrl(PortalUrl $url): void
    {
        $this->url = $url;
    }
}