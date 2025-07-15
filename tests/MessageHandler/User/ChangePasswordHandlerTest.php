<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\ChangePassword;
use App\MessageHandler\User\ChangePasswordHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ChangePasswordHandlerTest extends KernelTestCase
{
    private UserRepository $userRepository;

    private UserPasswordHasherInterface $passwordHasher;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->userRepository = static::getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(User::class);

        $this->passwordHasher = static::getContainer()
            ->get('security.user_password_hasher');
    }

    private function changePassword(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $this->userRepository->add($user);

        $message = new ChangePassword($user);
        $message->password = 'new_password';

        $handler = new ChangePasswordHandler(
            $this->userRepository,
            $this->passwordHasher
        );
        $handler->__invoke($message);
    }

    public function testPasswordIsChanged(): void
    {
        $this->changePassword();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertIsString($user->getPassword());
    }

    public function testPasswordResetTokenIsCleared(): void
    {
        $this->changePassword();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertNull($user->getPasswordResetToken());
    }

    public function testPasswordRequestedAtIsCleared(): void
    {
        $this->changePassword();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertNull($user->getPasswordRequestedAt());
    }
}
