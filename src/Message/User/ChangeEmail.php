<?php

declare(strict_types=1);

namespace App\Message\User;

final class ChangeEmail
{
    public function __construct(
        public readonly int $userId,
        public ?string $email = null,
    ) {
    }
}
