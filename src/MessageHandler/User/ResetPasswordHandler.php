<?php

namespace App\MessageHandler\User;

use App\Message\User\ResetPassword;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsMessageHandler]
final class ResetPasswordHandler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordEncoder
    ) {
    }

    public function __invoke(ResetPassword $message): void
    {
        $encodedPassword = $this->passwordEncoder->hashPassword($message->user, $message->password);
        $message->user->setPassword($encodedPassword);
        $this->userRepository->save();
    }
}
