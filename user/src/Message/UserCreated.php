<?php
namespace App\Message;

use App\Entity\User;

class UserCreated
{
    private array $userData;

    public function __construct(User $user)
    {
        $this->userData = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
        ];
    }

    public function getUserData(): array
    {
        return $this->userData;
    }
}