<?php

namespace App\Message\User;

readonly class ConfirmUser
{
    public function __construct(
        public int $userId
    ) {
    }
}
