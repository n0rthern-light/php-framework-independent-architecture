<?php

namespace Scraper\Shared\Domain\ValueObject;

class Contact
{
    private Phone $phone;
    private Email $email;

    public function __construct(Phone $phone, Email $email)
    {
        $this->phone = $phone;
        $this->email = $email;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}
