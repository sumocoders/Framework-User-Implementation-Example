<?php

namespace App\MessageHandler\User;

use App\Message\User\ConfirmUser;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ConfirmUserHandler
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function __invoke(ConfirmUser $message): void
    {
        $message->user->confirm();
        $this->userRepository->save();
    }
}
