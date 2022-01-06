<?php

namespace Core\Portal\Domain\Repository;

use Core\Portal\Domain\AggregateRoot\Portal;
use Core\Portal\Domain\Collection\PortalCollection;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface PortalRepositoryInterface
{
    public function save(Portal $portal): void;
    public function findOneById(int $portalId): ?Portal;
    public function fetchAll(?PaginationCriteria $paginationCriteria = null): PortalCollection;

    public function fetchTotalCount(): int;
}