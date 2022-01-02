<?php

namespace Scraper\Shared\Domain\ValueObject;

class Phone
{
    private string $countryCode;
    private string $phoneNumber;

    public function __construct(string $countryCode, string $phoneNumber)
    {
        $this->countryCode = $countryCode;
        $this->phoneNumber = $phoneNumber;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}