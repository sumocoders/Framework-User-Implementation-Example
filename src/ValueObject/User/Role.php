<?php

namespace App\ValueObject\User;

use App\Exception\User\InvalidRoleException;

class Role
{
    private const USER = 'ROLE_USER';
    private const ADMIN = 'ROLE_ADMIN';
    private const ALL = [
        self::USER,
        self::ADMIN,
    ];
    private string $role;

    public function __construct(string $role)
    {
        $this->role = $role;

        $this->validate();
    }

    private function validate(): void
    {
        if (!in_array($this->role, self::ALL)) {
            throw new InvalidRoleException($this->role);
        }
    }

    public static function user(): string
    {
        return self::USER;
    }

    public function __toString(): string
    {
        return $this->role;
    }

    public function getValue(): string
    {
        return $this->role;
    }

    /**
     * @return array<string, string> $roles
     */
    public static function getChoices(): array
    {
        return [
            'admin' => self::ADMIN,
        ];
    }
}
