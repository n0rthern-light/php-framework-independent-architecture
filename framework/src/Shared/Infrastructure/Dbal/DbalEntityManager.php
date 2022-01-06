<?php

namespace Framework\Shared\Infrastructure\Dbal;

use Core\Shared\Domain\Entity\Entity;
use Doctrine\DBAL\Connection;
use function PHPUnit\Framework\stringContains;

class DbalEntityManager
{
    private Connection $connection;
    private string $tableName;

    private ?Entity $entity = null;

    public function __construct(Connection $connection, string $tableName)
    {
        $this->connection = $connection;
        $this->tableName = $tableName;
    }

    public function takeCareOf(Entity $entity): void
    {
        $this->entity = $entity;
    }

    public function save(array $columnValues): void
    {
        $this->assertEntitySet();

        if ($this->entity->getId())
        {
            $this->update($columnValues);
            return;
        }

        $this->insert($columnValues);
    }

    private function update(array $columnValues): void
    {
        $keys = \array_keys($columnValues);
        $keysCount = count($keys);

        if (!$keysCount) {
            throw new \InvalidArgumentException('Keys must be set!');
        }

        $sql = '
            UPDATE `' . $this->tableName . '`
            SET';

        for($i = 0; $i < $keysCount; $i++) {
            $key = $keys[$i];

            $sql .= ' ' . $key . ' = ?';

            if ($i < $keysCount - 1) {
                $sql .= ', ';
            }
        }

        $sql = ' WHERE id = ?';

        $this->connection->executeStatement($sql, [
            ...array_values($columnValues),
            $this->entity->getId()
        ]);
    }

    private function insert(array $columnValues): void
    {
        $keys = \array_keys($columnValues);

        if (!count($keys)) {
            throw new \InvalidArgumentException('Keys must be set!');
        }

        $placeholders = \array_fill(0, count($columnValues), '?');

        $sql = '
            INSERT INTO `' . $this->tableName . '` (' . \implode(', ', $keys) . ')
            VALUES (' . \implode(', ', $placeholders) . ')
        ';

        $this->connection->executeStatement($sql, [...array_values($columnValues)]);

        /** @var int $lastInsertId */
        $lastInsertId = $this->connection->lastInsertId();
        $this->entity->setId($lastInsertId);
    }

    private function assertEntitySet(): void
    {
        if (!$this->entity) {
            throw new \BadFunctionCallException('Entity should be set before performing any action on it');
        }
    }
}