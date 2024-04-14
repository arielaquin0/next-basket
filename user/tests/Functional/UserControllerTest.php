<?php
namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{
    public function testCreateUserValidData(): void
    {
        $client = static::createClient();

        $client->request('POST', '/users', [], [], [], json_encode([
            'email'     => 'test@example.com',
            'firstName' => 'John',
            'lastName'  => 'Doe',
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertNotNull($client->getContainer()->get('messenger.bus.default'));
        $this->assertEquals('User created', $responseData['message']);
    }

    public function testCreateUserInvalidData(): void
    {
        $client = static::createClient();

        $client->request('POST', '/users', [], [], [], json_encode([
            // Missing required fields
        ]));

        $this->assertSame(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent(), true);

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('errors', $responseData);
        $this->assertCount(3, $responseData['errors']);
    }
}
