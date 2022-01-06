<?php

namespace Core\Portal\Domain\Collection;

use Core\Portal\Domain\Entity\PortalPlace;
use Core\Shared\Domain\Collection\Collection;

class PortalPlaceCollection extends Collection
{
    protected function getCollectionItemType(): string
    {
        return PortalPlace::class;
    }
}