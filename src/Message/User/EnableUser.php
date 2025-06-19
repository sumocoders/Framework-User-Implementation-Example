<?php

namespace App\Message\User;

use App\Entity\User\User;

class EnableUser
{
    public function __construct(
        public readonly User $user
    ) {
    }
}
