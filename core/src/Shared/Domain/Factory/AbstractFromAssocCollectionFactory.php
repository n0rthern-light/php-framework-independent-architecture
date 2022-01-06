<?php

namespace Core\Shared\Domain\Factory;


use Core\Shared\Domain\Collection\Collection;

abstract class AbstractFromAssocCollectionFactory implements FromAssocFactoryInterface
{
    public function fromAssocCollection(array $assocArrayCollection)
    {
        $class = $this->getCollectionClass();
        $collection = new $class();

        foreach($assocArrayCollection as $assocArray)
        {
            $collection->add($this->fromAssoc($assocArray));
        }

        return $collection;
    }

    abstract protected function getCollectionClass(): string;
}