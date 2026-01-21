<?php

namespace App\Message\User;

class DisableUser
{
    public function __construct(
        public readonly int $userId
    ) {
    }
}
