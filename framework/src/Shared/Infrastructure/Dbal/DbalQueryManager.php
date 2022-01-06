<?php

namespace Framework\Shared\Infrastructure\Dbal;

use Core\Shared\Domain\Criteria\PaginationCriteria;
use Doctrine\DBAL\Connection;

class DbalQueryManager
{
    private Connection $connection;
    private string $tableName;

    public function __construct(Connection $connection, string $tableName)
    {
        $this->connection = $connection;
        $this->tableName = $tableName;
    }

    public function selectOneById(int $id): array|bool
    {
        $sql = 'SELECT * FROM `' . $this->tableName . '` WHERE id = :id';

        return $this->connection->fetchAssociative($sql, ['id' => $id]);
    }

    public function selectAll(?PaginationCriteria $paginationCriteria = null): array
    {
        $sql = 'SELECT * FROM `' . $this->tableName . '` ORDER BY id DESC';

        return $this->connection->fetchAllAssociative($sql);
    }

    public function selectCount(): int
    {
        $sql = 'SELECT count(*) FROM `' . $this->tableName . '`';

        return $this->connection->fetchOne($sql);
    }
}