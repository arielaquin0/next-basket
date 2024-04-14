<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Message\UserCreated;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    public function testUserData(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setFirstName('John');
        $user->setLastName('Doe');

        $userCreated = new UserCreated($user);

        $userData = $userCreated->getUserData();

        $this->assertArrayHasKey('id', $userData);
        $this->assertEquals('test@example.com', $userData['email']);
        $this->assertEquals('John', $userData['firstName']);
        $this->assertEquals('Doe', $userData['lastname']);
    }
}
