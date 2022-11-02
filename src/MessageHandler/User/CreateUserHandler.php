<?php

namespace App\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\CreateUser;
use App\Message\User\SendConfirmation;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class CreateUserHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly MessageBusInterface $bus
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

        $this->bus->dispatch(new SendConfirmation($user));

        return $user;
    }
}
