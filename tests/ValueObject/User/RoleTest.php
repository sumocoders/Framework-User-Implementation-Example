<?php

declare(strict_types=1);

namespace App\Tests\ValueObject\User;

use App\ValueObject\User\Role;
use App\Exception\User\InvalidRoleException;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function testToStringReturnsRole(): void
    {
        $role = new Role(Role::user());

        $this->assertSame(Role::user(), (string) $role);
    }

    public function testGetValueReturnsRole(): void
    {
        $role = new Role(Role::user());

        $this->assertSame(Role::user(), $role->getValue());
    }

    public function testGetChoicesReturnsDefinedChoices(): void
    {
        $choices = Role::getChoices();

        $this->assertIsArray($choices);
        $this->assertArrayHasKey('admin', $choices);
        $this->assertSame('ROLE_ADMIN', $choices['admin']);
    }

    public function testThrowsExceptionForInvalidRole(): void
    {
        $this->expectException(InvalidRoleException::class);
        new Role('INVALID_ROLE');
    }
}
