<?php

namespace App\MessageHandler;

use App\Message\UserCreated;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UserCreatedHandler
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function __invoke(UserCreated $message)
    {
        $userId = $message->getId();
        $fullName = $message->getFirstName() . ' ' . $message->getLastName();
        $email = $message->getEmail();

        $logMessage = sprintf("User created: %s %s %s", $userId, $email, $fullName);
        $this->logger->info($logMessage);
    }
}
