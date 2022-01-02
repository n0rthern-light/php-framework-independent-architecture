<?php

namespace Scraper\Shared\Domain\Entity;

abstract class Entity
{
    protected int $id;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}