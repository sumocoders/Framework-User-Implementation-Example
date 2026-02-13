<?php

namespace App\MessageHandler\User;

use App\Message\User\Disable2Fa;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class Disable2FaHandler
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function __invoke(Disable2Fa $message): void
    {
        $message->user->clearTotpSecret();
        $message->user->clearBackupCodes();
        $this->userRepository->save();
    }
}
