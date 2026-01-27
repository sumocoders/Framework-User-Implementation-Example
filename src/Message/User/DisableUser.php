<?php

namespace App\Message\User;

readonly class DisableUser
{
    public function __construct(
        public int $userId
    ) {
    }
}
