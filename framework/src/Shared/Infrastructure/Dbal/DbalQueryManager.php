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

    public function selectOneByCriteria(array $criteria): array|bool
    {
        $keys = \array_keys($criteria);

        if (!count($keys)) {
            throw new \InvalidArgumentException('Criteria must be passed');
        }

        $sql = 'SELECT * FROM `' . $this->tableName . '`';

        $sql .= $this->buildSqlWherePartFromKeys($keys);

        return $this->connection->fetchAssociative($sql, array_values($criteria));
    }

    public function selectAll(?PaginationCriteria $paginationCriteria = null): array
    {
        $sql = 'SELECT * FROM `' . $this->tableName . '` ORDER BY id DESC';

        return $this->connection->fetchAllAssociative($sql);
    }

    public function selectAllByCriteria(array $criteria, ?PaginationCriteria $paginationCriteria = null): array
    {
        $keys = \array_keys($criteria);

        if (!count($keys)) {
            throw new \InvalidArgumentException('Criteria must be passed');
        }

        $sql = 'SELECT * FROM `' . $this->tableName . '`';

        $sql .= $this->buildSqlWherePartFromKeys($keys);

        return $this->connection->fetchAllAssociative($sql, array_values($criteria));
    }

    public function selectCount(): int
    {
        $sql = 'SELECT count(*) FROM `' . $this->tableName . '`';

        return $this->connection->fetchOne($sql);
    }

    private function buildSqlWherePartFromKeys(array $keys): string
    {
        $sql = ' WHERE ';

        $keysCount = \count($keys);
        for($i = 0; $i < $keysCount; $i++) {
            $key = $keys[$i];

            $sql .= '`' . $key . '` = ?';

            if ($i < $keysCount - 1) {
                $sql .= ', ';
            }
        }

        return $sql;
    }
}