<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\ConfirmUser;
use App\MessageHandler\User\ConfirmUserHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ConfirmUserHandlerTest extends KernelTestCase
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

    private function confirmUser(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $user->requestConfirmation();
        $this->userRepository->add($user);

        $message = new ConfirmUser($user);

        $handler = new ConfirmUserHandler($this->userRepository);
        $handler->__invoke($message);
    }

    public function testUserIsEnabled(): void
    {
        $this->confirmUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertTrue($user->isEnabled());
    }

    public function testConfirmedAtIsSet(): void
    {
        $this->confirmUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertEqualsWithDelta($user->getConfirmedAt(), new \DateTimeImmutable(), 1);
    }

    public function testConfirmationRequestedAtIsCleared(): void
    {
        $this->confirmUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertNull($user->getConfirmationRequestedAt());
    }

    public function testConformationTokenIsCleared(): void
    {
        $this->confirmUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertNull($user->getConfirmationToken());
    }
}
