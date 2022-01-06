<?php

namespace Framework\Portal\Infrastructure\Repository;

use Core\Portal\Domain\AggregateRoot\Portal;
use Core\Portal\Domain\Collection\PortalCollection;
use Core\Portal\Domain\Factory\PortalFactory;
use Core\Portal\Domain\Repository\PortalRepositoryInterface;
use Core\Shared\Domain\Criteria\PaginationCriteria;
use Doctrine\DBAL\Connection;
use Framework\Shared\Infrastructure\Dbal\DbalEntityManager;
use Framework\Shared\Infrastructure\Dbal\DbalQueryManager;

class DbalPortalRepository implements PortalRepositoryInterface
{
    public const TABLE_NAME = 'portal';

    private Connection $connection;
    private PortalFactory $portalFactory;

    private DbalEntityManager $dbalEntityManager;
    private DbalQueryManager $dbalQueryManager;

    public function __construct(Connection $connection, PortalFactory $portalFactory)
    {
        $this->connection = $connection;
        $this->portalFactory = $portalFactory;

        $this->dbalEntityManager = new DbalEntityManager($connection, self::TABLE_NAME);
        $this->dbalQueryManager = new DbalQueryManager($connection, self::TABLE_NAME);
    }

    public function save(Portal $portal): void
    {
        $this->dbalEntityManager->takeCareOf($portal);
        $this->dbalEntityManager->save([
            'name' => $portal->getName()->getValue(),
            'url' => $portal->getName()->getValue(),
        ]);
    }

    public function findOneById(int $portalId): ?Portal
    {
        $row = $this->dbalQueryManager->selectOneById($portalId);

        return $row ? $this->portalFactory->fromAssoc($row) : null;
    }

    public function fetchAll(?PaginationCriteria $paginationCriteria = null): PortalCollection
    {
        $rows = $this->dbalQueryManager->selectAll($paginationCriteria);

        return $this->portalFactory->fromAssocCollection($rows);
    }

    public function fetchTotalCount(): int
    {
        return $this->dbalQueryManager->selectCount();
    }
}