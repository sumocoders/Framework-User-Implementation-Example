<?php

namespace App\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\RegisterUser;
use App\Message\User\SendConfirmation;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsMessageHandler]
final readonly class RegisterUserHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordEncoder,
        private MessageBusInterface $messageBus,
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
        $this->messageBus->dispatch(new SendConfirmation($user->getId(), $message->locale));
    }
}
