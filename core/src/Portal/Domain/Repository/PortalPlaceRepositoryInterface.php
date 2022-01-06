<?php

namespace Core\Portal\Domain\Repository;

use Core\Portal\Domain\Collection\PortalPlaceCollection;
use Core\Portal\Domain\Entity\PortalPlace;
use Core\Shared\Domain\Criteria\PaginationCriteria;

interface PortalPlaceRepositoryInterface
{
    public function save(PortalPlace $portalPlace): void;
    public function findOneById(int $portalPlaceId): ?PortalPlace;
    public function findAllByPortalId(int $portalId): PortalPlaceCollection;
    public function fetchAll(?PaginationCriteria $paginationCriteria = null): PortalPlaceCollection;

    public function fetchTotalCount(): int;
}