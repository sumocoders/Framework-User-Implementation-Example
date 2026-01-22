<?php

namespace App\Message\User;

readonly class EnableUser
{
    public function __construct(
        public int $userId
    ) {
    }
}
