<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\ResetPassword;
use App\MessageHandler\User\ResetPasswordHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ResetPasswordHandlerTest extends KernelTestCase
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
        $this->passwordHasher = static::getContainer()->get('security.user_password_hasher');
    }

    private function resetPassword(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $this->userRepository->add($user);

        $message = new ResetPassword($user);
        $message->password = 'new_password';

        $handler = new ResetPasswordHandler(
            $this->userRepository,
            $this->passwordHasher
        );
        $handler->__invoke($message);
    }

    public function testPasswordIsChanged(): void
    {
        $this->resetPassword();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertTrue($this->passwordHasher->isPasswordValid($user, 'new_password'));
    }

    public function testPasswordResetTokenIsCleared(): void
    {
        $this->resetPassword();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertNull($user->getPasswordResetToken());
    }

    public function testPasswordRequestedAtIsCleared(): void
    {
        $this->resetPassword();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertNull($user->getPasswordRequestedAt());
    }
}
