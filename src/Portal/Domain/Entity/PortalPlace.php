<?php

namespace Core\Portal\Domain\Entity;

use Core\Portal\Domain\AggregateRoot\PortalEntity;
use Core\Portal\Domain\ValueObject\PortalPlaceName;
use Core\Portal\Domain\ValueObject\PortalPlaceUrl;

class PortalPlace extends PortalEntity
{
    private PortalPlaceName $name;
    private PortalPlaceUrl $url;

    public function getName(): PortalPlaceName
    {
        return $this->name;
    }

    public function setName(PortalPlaceName $name): void
    {
        $this->name = $name;
    }

    public function getUrl(): PortalPlaceUrl
    {
        return $this->url;
    }

    public function setUrl(PortalPlaceUrl $url): void
    {
        $this->url = $url;
    }
}