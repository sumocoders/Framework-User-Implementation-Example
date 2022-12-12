<?php

namespace App\MessageHandler\User;

use App\Message\User\UpdateUser;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class UpdateUserHandler
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function __invoke(UpdateUser $message): void
    {
        $message->getUser()->update(
            $message->email,
            $message->roles
        );

        $this->userRepository->save();
    }
}
