<?php

namespace App\MessageHandler\User;

use App\Message\User\DisableUser;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DisableUserHandler implements MessageHandlerInterface
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function __invoke(DisableUser $message): void
    {
        $user = $message->getUser();

        $user->disable();

        $this->userRepository->save();
    }
}
