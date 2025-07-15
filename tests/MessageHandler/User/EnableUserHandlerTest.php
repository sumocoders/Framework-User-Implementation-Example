<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\EnableUser;
use App\MessageHandler\User\EnableUserHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EnableUserHandlerTest extends KernelTestCase
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

    private function enableUser(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $user->disable();
        $this->userRepository->add($user);

        $message = new EnableUser($user);
        $handler = new EnableUserHandler($this->userRepository);
        $handler->__invoke($message);
    }

    public function testUserIsEnabled(): void
    {
        $this->enableUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertTrue($user->isEnabled());
    }
}
