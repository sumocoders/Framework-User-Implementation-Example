<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\User\User;
use App\Repository\User\UserRepository;
use App\Security\Exception\UnconfirmedAccountException;
use App\Security\UserChecker;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserCheckerTest extends TestCase
{
    private UserChecker $mockUserChecker;

    protected function setUp(): void
    {
        $mockRouter = $this->createMock(RouterInterface::class);
        $mockRouter->expects($this->once())->method('generate');

        $mockTranslator = $this->createMock(TranslatorInterface::class);
        $mockTranslator->expects($this->once())
            ->method('trans')
            ->willReturn('Foo');

        $mockUserRepository = $this->createMock(UserRepository::class);

        $this->mockUserChecker = new UserChecker(
            $mockTranslator,
            $mockRouter,
            $mockUserRepository
        );
    }

    public function testCheckPreAuthFailsIfUnconfirmed()
    {
        $this->expectException(UnconfirmedAccountException::class);

        $userMock = new User('john.doe@foo.bar', []);
        $this->mockUserChecker->checkPreAuth($userMock);
    }

    public function testCheckPreAuthFailsIfEnabled()
    {
        $this->expectException(DisabledException::class);

        $userMock = new User('john.doe@foo.bar', []);
        $userMock->confirm();
        $userMock->disable();
        $this->mockUserChecker->checkPreAuth($userMock);
    }

    public function testCheckPostAuthErasesPasswordRequest()
    {
        $userMock = new User('john.doe@foo.bar', []);
        $userMock->requestPassword();
        $this->mockUserChecker->checkPostAuth($userMock);
        $this->assertNull($userMock->getPasswordResetToken());
        $this->assertNull($userMock->getPasswordRequestedAt());
    }
}
