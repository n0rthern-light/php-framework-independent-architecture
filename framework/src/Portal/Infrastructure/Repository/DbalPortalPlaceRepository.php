<?php

namespace Framework\Portal\Infrastructure\Repository;

use Core\Portal\Domain\Collection\PortalPlaceCollection;
use Core\Portal\Domain\Entity\PortalPlace;
use Core\Portal\Domain\Factory\PortalPlaceFactory;
use Core\Portal\Domain\Repository\PortalPlaceRepositoryInterface;
use Core\Shared\Domain\Criteria\PaginationCriteria;
use Doctrine\DBAL\Connection;
use Framework\Shared\Infrastructure\Dbal\DbalEntityManager;

class DbalPortalPlaceRepository implements PortalPlaceRepositoryInterface
{
    private const TABLE_NAME = 'portal_place';

    private Connection $connection;
    private PortalPlaceFactory $portalPlaceFactory;

    private DbalEntityManager $dbalEntityManager;

    public function __construct(Connection $connection, PortalPlaceFactory $portalPlaceFactory)
    {
        $this->connection = $connection;
        $this->portalPlaceFactory = $portalPlaceFactory;

        $this->dbalEntityManager = new DbalEntityManager($connection, self::TABLE_NAME);
    }

    public function save(PortalPlace $portalPlace): void
    {
        $this->dbalEntityManager->takeCareOf($portalPlace);
        $this->dbalEntityManager->save([
            'portal_id' => $portalPlace->getPortalId(),
            'name' => $portalPlace->getName()->getValue(),
            'url' => $portalPlace->getUrl()->getValue(),
        ]);
    }

    public function findOneById(int $portalPlaceId): ?PortalPlace
    {
        // TODO: Implement findOneById() method.
    }

    public function findAllByPortalId(int $portalId): PortalPlaceCollection
    {
        // TODO: Implement findAllByPortalId() method.
    }

    public function fetchAll(?PaginationCriteria $paginationCriteria = null): PortalPlaceCollection
    {
        // TODO: Implement fetchAll() method.
    }

    public function fetchTotalCount(): int
    {
        // TODO: Implement fetchTotalCount() method.
    }
}