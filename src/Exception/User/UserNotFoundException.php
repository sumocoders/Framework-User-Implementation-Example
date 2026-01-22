<?php

namespace App\Exception\User;

use RuntimeException;

class UserNotFoundException extends RuntimeException
{
    public static function create(int $id): self
    {
        return new self(
            'User entity with id: ' . $id . ' was not found',
        );
    }
}
