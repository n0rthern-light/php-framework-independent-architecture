<?php

namespace Core\Auction\Application\Dto;

class CreateAuctionDto
{
    private string $name;
    private string $url;
    private string $price;
    private array $photos;
    private string $author;
    private string $phone;
    private string $email;
    private string $location;

    public function __construct(string $name, string $url, string $price, array $photos, string $author, string $phone, string $email, string $location)
    {
        $this->name = $name;
        $this->url = $url;
        $this->price = $price;
        $this->photos = $photos;
        $this->author = $author;
        $this->phone = $phone;
        $this->email = $email;
        $this->location = $location;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLocation(): string
    {
        return $this->location;
    }
}