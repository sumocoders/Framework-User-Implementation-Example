<?php

namespace App\Message\User;

class SendConfirmation
{
    public function __construct(
        public readonly int $userId,
        public readonly string $locale
    ) {
    }
}
