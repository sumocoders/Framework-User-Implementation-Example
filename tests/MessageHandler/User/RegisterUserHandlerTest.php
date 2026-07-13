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
        // @mago-expect lint:no-literal-password
        $message->password = 'password';
        $message->locale = 'nl';

        $handler = new RegisterUserHandler(
            $this->userRepository,
            $this->passwordHasher,
            $this->messageBus,
        );
        $handler->__invoke($message);
    }

    public function testUserIsCreatedWithCorrectData(): void
    {
        $this->registerUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        static::assertInstanceOf(User::class, $user);
        static::assertSame('user@example.com', $user->getEmail());
        static::assertContains('ROLE_USER', $user->getRoles());
    }

    public function testUserConfirmationTokenIsGenerated(): void
    {
        $this->registerUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        // this is actually done by SendConfirmationHandler
        static::assertIsString($user->getConfirmationToken());
        static::assertEqualsWithDelta($user->getConfirmationRequestedAt(), new \DateTimeImmutable(), 1);
    }

    public function testEmailIsSent(): void
    {
        $this->registerUser();

        static::assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        static::assertEmailHeaderSame(
            $email,
            'To',
            '"user@example.com" <user@example.com>',
        );
    }

    public function testEmailContainsConfirmationToken(): void
    {
        $this->registerUser();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        static::assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        static::assertEmailTextBodyContains($email, $user->getConfirmationToken());
        static::assertEmailHtmlBodyContains($email, $user->getConfirmationToken());
    }
}
