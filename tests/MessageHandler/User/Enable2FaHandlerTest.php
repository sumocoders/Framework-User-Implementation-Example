<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\Enable2Fa;
use App\MessageHandler\User\Enable2FaHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class Enable2FaHandlerTest extends KernelTestCase
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

    private function enable2fa(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $this->userRepository->add($user);

        $message = new Enable2Fa($user, 'super-secret-string');

        $handler = new Enable2FaHandler($this->userRepository);
        $handler->__invoke($message);
    }

    public function testTotpIsEnabled(): void
    {
        $this->enable2fa();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertTrue($user->isTotpAuthenticationEnabled());
    }

    public function testHasBackupCodes(): void
    {
        $this->enable2fa();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertNotEmpty($user->getBackupCodes());
        $this->assertCount(6, $user->getBackupCodes());
    }
}
