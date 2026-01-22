<?php

namespace App\MessageHandler\User;

use App\Exception\User\UserNotFoundException;
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
        $user = $this->userRepository->find($message->userId);
        if ($user === null) {
            throw UserNotFoundException::create($message->userId);
        }
        $encodedPassword = $this->passwordEncoder->hashPassword($user, $message->password);
        $user->setPassword($encodedPassword);
        $this->userRepository->save();
    }
}
