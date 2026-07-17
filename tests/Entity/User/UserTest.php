<?php

namespace App\Tests\Entity\User;

use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testUserIsUpdated(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $user->update('user-altered@example.com', ['ROLE_USER']);

        static::assertSame('user-altered@example.com', $user->getEmail());
        static::assertSame(['ROLE_USER'], $user->getRoles());
    }

    public function testUsernameIsSameAsEmail(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);

        static::assertSame('user@example.com', $user->getUsername());
        static::assertSame('user@example.com', $user->getOriginUsername());
    }

    public function testUserIdentifierIsSameAsEmail(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);

        static::assertSame('user@example.com', $user->getUserIdentifier());
    }

    public function testDisplayRolesForAdmin(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);

        static::assertEquals(['admin', 'user'], $user->getDisplayRoles());
    }

    public function testDisplayRolesForUser(): void
    {
        $user = new User('user@example.com', []);

        static::assertEquals(['user'], $user->getDisplayRoles());

        $user = new User('user@example.com', ['ROLE_USER']);

        static::assertEquals(['user'], $user->getDisplayRoles());
    }

    public function testPropertiesAfterConfirm(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $user->requestConfirmation();
        $user->confirm();

        static::assertNull($user->getConfirmationToken());
        static::assertNull($user->getConfirmationRequestedAt());
        static::assertEqualsWithDelta($user->getConfirmedAt(), new \DateTimeImmutable(), 1);
        static::assertTrue($user->isEnabled());
        static::assertTrue($user->isConfirmed());
    }

    public function testUserIsDisabledByDefault(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);

        static::assertFalse($user->isEnabled());
    }

    public function testUserIsEnabledAfterEnable(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $user->enable();

        static::assertTrue($user->isEnabled());
    }

    public function testUserIsDisabledAfterDisable(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $user->disable();

        static::assertFalse($user->isEnabled());
    }
}
