<?php

namespace App\Tests\Security;

use App\Entity\User\User;
use App\Repository\User\UserRepository;
use App\Security\Exception\UnconfirmedAccountException;
use App\Security\UserChecker;
use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AllowMockObjectsWithoutExpectations]
class UserCheckerTest extends KernelTestCase
{
    private UserChecker $userChecker;

    protected function setUp(): void
    {
        $this->userChecker = new UserChecker(
            $this->createMock(TranslatorInterface::class),
            $this->createMock(RouterInterface::class),
            $this->createMock(UserRepository::class)
        );
    }

    public function testUnconfirmedUserThrowsException(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);

        $this->expectException(UnconfirmedAccountException::class);

        $this->userChecker->checkPreAuth($user);
    }

    public function testDisabledUserThrowsException(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $user->confirm();
        $user->disable();

        $this->expectException(DisabledException::class);

        $this->userChecker->checkPreAuth($user);
    }

    public function testPostAuthErasesPasswordResetToken(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $user->requestPassword();

        $this->userChecker->checkPostAuth($user);

        $this->assertNull($user->getPasswordResetToken());
        $this->assertNull($user->getPasswordRequestedAt());
    }
}
