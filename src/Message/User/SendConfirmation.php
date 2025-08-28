<?php

namespace App\Message\User;

use App\Entity\User\User;

class SendConfirmation
{
    public function __construct(
        public readonly User $user,
        public readonly string $locale
    ) {
    }
}
