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
    public function testCheckPreAuthFailsIfUnconfirmed()
    {
        $mockRouter = $this->createMock(RouterInterface::class);
        $mockRouter->expects($this->once())->method('generate');

        $mockTranslator = $this->createMock(TranslatorInterface::class);
        $mockTranslator->expects($this->once())
            ->method('trans')
            ->willReturn('Foo');

        $mockUserRepository = $this->createMock(UserRepository::class);

        $mockUserChecker = new UserChecker(
            $mockTranslator,
            $mockRouter,
            $mockUserRepository
        );

        $this->expectException(UnconfirmedAccountException::class);

        $userMock = new User('john.doe@foo.bar', []);
        $mockUserChecker->checkPreAuth($userMock);
    }

    public function testCheckPreAuthFailsIfEnabled()
    {
        $mockRouter = $this->createMock(RouterInterface::class);
        $mockTranslator = $this->createMock(TranslatorInterface::class);
        $mockUserRepository = $this->createMock(UserRepository::class);

        $mockUserChecker = new UserChecker(
            $mockTranslator,
            $mockRouter,
            $mockUserRepository
        );

        $this->expectException(DisabledException::class);

        $userMock = new User('john.doe@foo.bar', []);
        $userMock->confirm();
        $userMock->disable();
        $mockUserChecker->checkPreAuth($userMock);
    }

    public function testCheckPostAuthErasesPasswordRequest()
    {
        $mockRouter = $this->createMock(RouterInterface::class);
        $mockTranslator = $this->createMock(TranslatorInterface::class);
        $mockUserRepository = $this->createMock(UserRepository::class);

        $mockUserChecker = new UserChecker(
            $mockTranslator,
            $mockRouter,
            $mockUserRepository
        );

        $userMock = new User('john.doe@foo.bar', []);
        $userMock->requestPassword();
        $mockUserChecker->checkPostAuth($userMock);
        $this->assertNull($userMock->getPasswordResetToken());
        $this->assertNull($userMock->getPasswordRequestedAt());
    }
}
