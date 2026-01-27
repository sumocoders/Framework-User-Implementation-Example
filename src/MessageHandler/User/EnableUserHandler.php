<?php

namespace App\MessageHandler\User;

use App\Exception\User\UserNotFoundException;
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
        if ($user === null) {
            throw UserNotFoundException::create($message->userId);
        }
        $user->enable();
        $this->userRepository->save();
    }
}
