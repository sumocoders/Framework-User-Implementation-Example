<?php

namespace App\MessageHandler\User;

use App\Message\User\ChangePassword;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsMessageHandler]
final class ChangePasswordHandler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordEncoder
    ) {
    }

    public function __invoke(ChangePassword $message): void
    {
        $encodedPassword = $this->passwordEncoder->hashPassword($message->getUser(), $message->password);

        $message->getUser()->setPassword($encodedPassword);

        $this->userRepository->save();
    }
}
