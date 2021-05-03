<?php

namespace App\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\CreateUser;
use App\Message\User\SendConfirmation;
use App\Message\User\UpdateUser;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UpdateUserHandler implements MessageHandlerInterface
{
    private UserRepository $userRepository;
    private UserPasswordEncoderInterface $passwordEncoder;
    private MessageBusInterface $bus;

    public function __construct(
        UserRepository $userRepository,
        UserPasswordEncoderInterface $passwordEncoder,
        MessageBusInterface $bus
    ) {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->bus = $bus;
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
