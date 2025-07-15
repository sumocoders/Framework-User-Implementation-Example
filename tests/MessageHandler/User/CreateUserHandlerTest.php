<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\CreateUser;
use App\MessageHandler\User\CreateUserHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateUserHandlerTest extends KernelTestCase
{
    private UserRepository $userRepository;
    private MessageBusInterface $messageBus;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->userRepository = static::getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(User::class);
        $this->messageBus = static::getContainer()->get('messenger.default_bus');
    }

    private function createUser(): void
    {
        $message = new CreateUser();
        $message->email = 'user@example.com';
        $message->roles = ['ROLE_USER'];

        $handler = new CreateUserHandler(
            $this->userRepository,
            $this->messageBus
        );
        $handler->__invoke($message);
    }

    public function testUserIsCreatedWithCorrectData(): void
    {
        $this->createUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('user@example.com', $user->getEmail());
        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    public function testUserPasswordResetTokenIsGenerated(): void
    {
        $this->createUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertIsString($user->getPasswordResetToken());
        $this->assertEqualsWithDelta($user->getPasswordRequestedAt(), new \DateTimeImmutable(), 1);
    }

    public function testUserConfirmationTokenIsGenerated(): void
    {
        $this->createUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        // this is actually done by SendConfirmationHandler
        $this->assertIsString($user->getConfirmationToken());
        $this->assertEqualsWithDelta($user->getConfirmationRequestedAt(), new \DateTimeImmutable(), 1);
    }
}
