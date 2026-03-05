<?php

declare(strict_types=1);

namespace App\MessageHandler\User;

use App\Message\User\ChangeEmail;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class ChangeEmailHandler
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function __invoke(ChangeEmail $message): void
    {
        $user = $this->userRepository->find($message->userId);

        if ($user === null) {
            return;
        }

        $user->changeEmail((string) $message->email);

        $this->userRepository->save();
    }
}
