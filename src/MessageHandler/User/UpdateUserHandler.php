<?php

namespace App\MessageHandler\User;

use App\Message\User\UpdateUser;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class UpdateUserHandler implements MessageHandlerInterface
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
