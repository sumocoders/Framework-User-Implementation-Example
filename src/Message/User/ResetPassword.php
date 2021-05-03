<?php

namespace App\Message\User;

use App\Entity\User\User;

class ResetPassword
{
    private User $user;
    public string $password;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}