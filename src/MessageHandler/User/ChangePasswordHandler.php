<?php

namespace App\MessageHandler\User;

use App\Message\User\ChangePassword;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class ChangePasswordHandler implements MessageHandlerInterface
{
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordEncoder
    ) {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function __invoke(ChangePassword $message): void
    {
        $encodedPassword = $this->passwordEncoder->hashPassword($message->getUser(), $message->password);

        $message->getUser()->setPassword($encodedPassword);

        $this->userRepository->save();
    }
}
