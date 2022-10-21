<?php

namespace App\Message\User;

use App\Entity\User\User;

class ResetPassword
{
    public string $password;

    public function __construct(private readonly User $user)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
