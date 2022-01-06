<?php

namespace Core\Shared\Domain\Factory;

use Core\Shared\Domain\Entity\Entity;

interface FromAssocFactoryInterface
{
    public function fromAssoc(array $assocArray): Entity;
}