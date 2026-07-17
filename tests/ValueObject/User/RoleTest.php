<?php

declare(strict_types=1);

namespace App\Tests\ValueObject\User;

use App\Exception\User\InvalidRoleException;
use App\ValueObject\User\Role;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function testToStringReturnsRole(): void
    {
        $role = new Role(Role::user());

        static::assertSame(Role::user(), (string) $role);
    }

    public function testGetValueReturnsRole(): void
    {
        $role = new Role(Role::user());

        static::assertSame(Role::user(), $role->getValue());
    }

    public function testGetChoicesReturnsDefinedChoices(): void
    {
        $choices = Role::getChoices();

        static::assertIsArray($choices);
        static::assertArrayHasKey('admin', $choices);
        static::assertSame('ROLE_ADMIN', $choices['admin']);
    }

    public function testThrowsExceptionForInvalidRole(): void
    {
        $this->expectException(InvalidRoleException::class);
        new Role('INVALID_ROLE');
    }
}
