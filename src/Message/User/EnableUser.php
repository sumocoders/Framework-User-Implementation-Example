<?php

namespace App\Message\User;

class EnableUser
{
    public function __construct(
        public readonly int $userId
    ) {
    }
}
