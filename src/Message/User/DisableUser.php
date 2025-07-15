<?php

namespace App\Message\User;

use App\Entity\User\User;

class DisableUser
{
    public function __construct(
        public readonly User $user
    ) {
    }
}
