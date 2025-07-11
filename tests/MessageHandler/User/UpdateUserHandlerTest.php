<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\UpdateUser;
use App\MessageHandler\User\UpdateUserHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UpdateUserHandlerTest extends KernelTestCase
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

    private function updateUser(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($user);

        $message = new UpdateUser($user);
        $message->email = 'updated@example.com';
        $message->roles = ['ROLE_USER'];

        $handler = new UpdateUserHandler($this->userRepository);
        $handler->__invoke($message);
    }

    public function testEmailIsUpdated(): void
    {
        $this->updateUser();
        $user = $this->userRepository->findOneBy(['email' => 'updated@example.com']);

        $this->assertEquals('updated@example.com', $user->getEmail());
    }

    public function testRolesAreUpdated(): void
    {
        $this->updateUser();
        $user = $this->userRepository->findOneBy(['email' => 'updated@example.com']);

        $this->assertContains('ROLE_USER', $user->getRoles());
        $this->assertNotContains('ROLE_ADMIN', $user->getRoles());
    }
}
