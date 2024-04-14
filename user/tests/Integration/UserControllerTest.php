<?php

namespace App\Tests\Integration;

use App\Controller\UserController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class UserControllerTest extends KernelTestCase
{
    private UserController $userController;

    private MessageBusInterface $messageBus;

    protected function setUp(): void
    {
        parent::setUp();

        $userController = self::getContainer()->get(UserController::class);
        $this->userController = $userController;

        $messageBus = self::getContainer()->get('messenger.bus.default');
        $this->messageBus = $messageBus;
    }

    public function testCreateUser(): void
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'email'     => 'test@example.com',
            'firstName' => 'John',
            'lastName'  => 'Doe',
        ]));

        $request->headers->set('Content-Type', 'application/json');

        $response = $this->userController->createUser($request, $this->messageBus);
        $responseData = json_decode($response->getContent(), true);

        $this->assertSame(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertArrayHasKey('message', $responseData);
        $this->assertSame('User created', $responseData['message']);
    }
}
