<?php

namespace App\Message\User;

use App\Entity\User\User;

final readonly class Disable2Fa
{
    public function __construct(
        public User $user,
    ) {
    }
}
