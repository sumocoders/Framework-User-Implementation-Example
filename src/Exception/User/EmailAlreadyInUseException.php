<?php

namespace App\Exception\User;

use RuntimeException;

class EmailAlreadyInUseException extends RuntimeException
{
    public static function create(string $email): self
    {
        return new self(
            'Email address ' . $email . ' is already in use by another user',
        );
    }
}
