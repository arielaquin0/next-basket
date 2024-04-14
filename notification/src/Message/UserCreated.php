<?php
namespace App\Message;

class UserCreated
{
    private array $userData;

    public function __construct(array $userData)
    {
        $this->userData = $userData;
    }

    public function getUserData(): array
    {
        return $this->userData;
    }

    public function getId(): int
    {
        return $this->userData['id'];
    }

    public function getEmail(): string
    {
        return $this->userData['email'];
    }

    public function getFirstName(): string
    {
        return $this->userData['firstName'];
    }

    public function getLastName(): string
    {
        return $this->userData['lastName'];
    }
}