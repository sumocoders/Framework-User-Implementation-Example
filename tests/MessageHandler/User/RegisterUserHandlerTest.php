<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\RegisterUser;
use App\MessageHandler\User\RegisterUserHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserHandlerTest extends KernelTestCase
{
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $passwordHasher;
    private MessageBusInterface $messageBus;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->userRepository = static::getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(User::class);
        $this->passwordHasher = static::getContainer()->get('security.user_password_hasher');
        $this->messageBus = static::getContainer()->get('messenger.default_bus');
    }

    private function registerUser(): void
    {
        $message = new RegisterUser();
        $message->email = 'user@example.com';
        $message->roles = ['ROLE_USER'];
        $message->password = 'password';
        $message->locale = 'nl';

        $handler = new RegisterUserHandler(
            $this->userRepository,
            $this->passwordHasher,
            $this->messageBus
        );
        $handler->__invoke($message);
    }

    public function testUserIsCreatedWithCorrectData(): void
    {
        $this->registerUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('user@example.com', $user->getEmail());
        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    public function testUserConfirmationTokenIsGenerated(): void
    {
        $this->registerUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        // this is actually done by SendConfirmationHandler
        $this->assertIsString($user->getConfirmationToken());
        $this->assertEqualsWithDelta($user->getConfirmationRequestedAt(), new \DateTimeImmutable(), 1);
    }

    public function testEmailIsSent(): void
    {
        $this->registerUser();

        $this->assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        $this->assertEmailHeaderSame(
            $email,
            'To',
            '"user@example.com" <user@example.com>'
        );
    }

    public function testEmailContainsConfirmationToken(): void
    {
        $this->registerUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        $this->assertEmailTextBodyContains($email, $user->getConfirmationToken());
        $this->assertEmailHtmlBodyContains($email, $user->getConfirmationToken());
    }
}
