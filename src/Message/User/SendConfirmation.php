<?php

namespace App\Message\User;

readonly class SendConfirmation
{
    public function __construct(
        public int $userId,
        public string $locale
    ) {
    }
}
