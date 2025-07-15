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

        $this->assertSame('user-altered@example.com', $user->getEmail());
        $this->assertSame(['ROLE_USER'], $user->getRoles());
    }

    public function testUsernameIsSameAsEmail(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);

        $this->assertSame('user@example.com', $user->getUsername());
        $this->assertSame('user@example.com', $user->getOriginUsername());
    }

    public function testUserIdentifierIsSameAsEmail(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);

        $this->assertSame('user@example.com', $user->getUserIdentifier());
    }

    public function testDisplayRolesForAdmin(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);

        $this->assertEquals(['admin', 'user'], $user->getDisplayRoles());
    }

    public function testDisplayRolesForUser(): void
    {
        $user = new User('user@example.com', []);

        $this->assertEquals(['user'], $user->getDisplayRoles());

        $user = new User('user@example.com', ['ROLE_USER']);

        $this->assertEquals(['user'], $user->getDisplayRoles());
    }

    public function testPropertiesAfterConfirm(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $user->requestConfirmation();
        $user->confirm();

        $this->assertNull($user->getConfirmationToken());
        $this->assertNull($user->getConfirmationRequestedAt());
        $this->assertEqualsWithDelta($user->getConfirmedAt(), new \DateTimeImmutable(), 1);
        $this->assertTrue($user->isEnabled());
        $this->assertTrue($user->isConfirmed());
    }

    public function testUserIsDisabledByDefault(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);

        $this->assertFalse($user->isEnabled());
    }

    public function testUserIsEnabledAfterEnable(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $user->enable();

        $this->assertTrue($user->isEnabled());
    }

    public function testUserIsDisabledAfterDisable(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $user->disable();

        $this->assertFalse($user->isEnabled());
    }
}
