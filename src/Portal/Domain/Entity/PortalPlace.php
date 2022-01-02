<?php

namespace Scraper\Portal\Domain\Entity;

use Scraper\Portal\Domain\AggregateRoot\PortalEntity;
use Scraper\Portal\Domain\ValueObject\PortalPlaceName;
use Scraper\Portal\Domain\ValueObject\PortalPlaceUrl;

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