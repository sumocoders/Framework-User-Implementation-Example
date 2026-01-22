<?php

namespace App\MessageHandler\User;

use App\Exception\User\UserNotFoundException;
use App\Message\User\DisableUser;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class DisableUserHandler
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function __invoke(DisableUser $message): void
    {
        $user = $this->userRepository->find($message->userId);
        if ($user === null) {
            throw UserNotFoundException::create($message->userId);
        }
        $user->disable();
        $this->userRepository->save();
    }
}
