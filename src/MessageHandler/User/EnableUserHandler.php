<?php

namespace App\MessageHandler\User;

use App\Message\User\EnableUser;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class EnableUserHandler
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function __invoke(EnableUser $message): void
    {
        $user = $this->userRepository->find($message->userId);
        $user->enable();
        $this->userRepository->save();
    }
}
