<?php

namespace App\MessageHandler\User;

use App\Message\User\EnableUser;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class EnableUserHandler implements MessageHandlerInterface
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function __invoke(EnableUser $message): void
    {
        $user = $message->getUser();

        $user->enable();

        $this->userRepository->save();
    }
}
