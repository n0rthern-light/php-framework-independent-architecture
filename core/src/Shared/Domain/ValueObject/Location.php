<?php

namespace Core\Shared\Domain\ValueObject;

class Location
{
    private string $city;
    private string $country;
    private ?string $zip;

    public function __construct(string $city, string $country, ?string $zip = null)
    {
        $this->city = $city;
        $this->country = $country;
        $this->zip = $zip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }
}