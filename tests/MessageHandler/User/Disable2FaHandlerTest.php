<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\Disable2Fa;
use App\MessageHandler\User\Disable2FaHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class Disable2FaHandlerTest extends KernelTestCase
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

    private function disable2fa(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $user->setTotpSecret('super-secret-string');
        $user->addBackupCode('backup-code-1');
        $this->userRepository->add($user);

        $message = new Disable2Fa($user, 'super-secret-string');

        $handler = new Disable2FaHandler($this->userRepository);
        $handler->__invoke($message);
    }

    public function testTotpIsNotEnabled(): void
    {
        $this->disable2fa();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertFalse($user->isTotpAuthenticationEnabled());
    }

    public function testHasNoBackupCodes(): void
    {
        $this->disable2fa();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertEmpty($user->getBackupCodes());
    }
}
