<?php

namespace App\MessageHandler\User;

use App\Message\User\DisableUser;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DisableUserHandler implements MessageHandlerInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function __invoke(DisableUser $message): void
    {
        $user = $message->getUser();

        $user->disable();

        $this->userRepository->save();
    }
}
