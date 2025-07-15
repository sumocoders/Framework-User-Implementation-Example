<?php

namespace App\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\CreateUser;
use App\Message\User\SendConfirmation;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final class CreateUserHandler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private MessageBusInterface $messageBus
    ) {
    }

    public function __invoke(CreateUser $message): User
    {
        $user = new User(
            $message->email,
            $message->roles
        );
        $user->requestPassword();
        $this->userRepository->add($user);
        $this->messageBus->dispatch(new SendConfirmation($user));

        return $user;
    }
}
