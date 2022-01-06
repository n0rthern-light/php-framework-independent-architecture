<?php

namespace Core\Portal\Domain\Collection;

use Core\Portal\Domain\AggregateRoot\Portal;
use Core\Shared\Domain\Collection\Collection;

class PortalCollection extends Collection
{
    protected function getCollectionItemType(): string
    {
        return Portal::class;
    }
}