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

    public function testNewUserIsNotAnAzureUser(): void
    {
        $user = new User('user@example.com', []);

        $this->assertFalse($user->isAzureUser());
        $this->assertNull($user->getAzureObjectId());
    }

    public function testLinkAzureAccount(): void
    {
        $user = new User('user@example.com', []);
        $user->linkAzureAccount('azure-oid-123');

        $this->assertTrue($user->isAzureUser());
        $this->assertSame('azure-oid-123', $user->getAzureObjectId());
    }

    public function testUnlinkAzureAccount(): void
    {
        $user = new User('user@example.com', []);
        $user->linkAzureAccount('azure-oid-123');
        $user->unlinkAzureAccount();

        $this->assertFalse($user->isAzureUser());
        $this->assertNull($user->getAzureObjectId());
    }

    public function testCreateFromAzureProfileIsEnabledAndConfirmed(): void
    {
        $user = User::createFromAzureProfile('azure@sumocoders.be', 'azure-oid-123');

        $this->assertSame('azure@sumocoders.be', $user->getEmail());
        $this->assertSame('azure-oid-123', $user->getAzureObjectId());
        $this->assertTrue($user->isAzureUser());
        $this->assertTrue($user->isEnabled());
        $this->assertTrue($user->isConfirmed());
        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    public function testCreateFromAzureProfileWithCustomRoles(): void
    {
        $user = User::createFromAzureProfile('azure@sumocoders.be', 'azure-oid-123', ['ROLE_ADMIN']);

        $this->assertContains('ROLE_ADMIN', $user->getRoles());
        $this->assertContains('ROLE_USER', $user->getRoles());
    }
}
