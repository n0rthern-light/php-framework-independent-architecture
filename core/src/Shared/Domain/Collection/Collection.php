<?php

namespace Core\Shared\Domain\Collection;

use ArrayIterator;
use IteratorAggregate;

abstract class Collection implements IteratorAggregate
{
    protected array $items = [];

    abstract protected function getCollectionItemType(): string;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function add(mixed $item): void
    {
        $this->assertItemCorrectType($item);

        $this->items[] = $item;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function shift(): mixed
    {
        return array_shift($this->items);
    }

    public function each(callable $fn): static
    {
        foreach ($this->items as $item) {
            $fn($item);
        }

        return $this;
    }

    public function map(callable $fn): self
    {
        $newCollection = new static();

        $this->each(function ($item) use (&$newCollection, $fn) {
            $newCollection->add($fn($item));
        });

        return $newCollection;
    }

    public function toNativeArray(): array
    {
        $array = [];

        $this->each(function ($item) use (&$array) {
            $array[] = $item;
        });

        return $array;
    }

    private function assertItemCorrectType(mixed $item): void
    {
        $collectionItemType = $this->getCollectionItemType();
        if ($item::class !== $collectionItemType) {
            throw new \InvalidArgumentException('Item added to this collection should be of type: '.$collectionItemType);
        }
    }
}
