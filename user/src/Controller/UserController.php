<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Message\UserCreated;
use App\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserRepositoryInterface $userRepository
    ) {}

    #[Route('/users', name: 'create_user', methods: ['POST'])]
    public function createUser(Request $request, MessageBusInterface $messageBus): JsonResponse
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userRepository->save($user);

            $messageBus->dispatch(new UserCreated($user));

            return new JsonResponse(['message' => 'User created'], JsonResponse::HTTP_CREATED);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[$error->getOrigin()->getName()] = $error->getMessage();
        }

        return new JsonResponse(['errors' => $errors], JsonResponse::HTTP_BAD_REQUEST);
    }
}
