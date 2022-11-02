<?php

namespace App\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\RegisterUser;
use App\Message\User\SendConfirmation;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegisterUserHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordEncoder,
        private readonly MessageBusInterface $bus
    ) {
    }

    public function __invoke(RegisterUser $message): void
    {
        $user = new User(
            $message->email,
            $message->roles
        );

        $encodedPassword = $this->passwordEncoder->hashPassword($user, $message->password);

        $user->setPassword($encodedPassword);

        $this->userRepository->add($user);

        $this->bus->dispatch(new SendConfirmation($user));
    }
}
