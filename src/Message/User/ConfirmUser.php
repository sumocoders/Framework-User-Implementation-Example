<?php

namespace App\Message\User;

class ConfirmUser
{
    public function __construct(
        public readonly int $userId
    ) {
    }
}
