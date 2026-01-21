<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\DisableUser;
use App\MessageHandler\User\DisableUserHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DisableUserHandlerTest extends KernelTestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->userRepository = static::getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(User::class);
    }

    private function disableUser(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $user->enable();
        $this->userRepository->add($user);

        $message = new DisableUser($user->getId());
        $handler = new DisableUserHandler($this->userRepository);
        $handler->__invoke($message);
    }

    public function testUserIsDisabled(): void
    {
        $this->disableUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertFalse($user->isEnabled());
    }
}
