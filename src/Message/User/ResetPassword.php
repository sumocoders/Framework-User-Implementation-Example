<?php

namespace App\Message\User;

use Symfony\Component\Validator\Constraints as Assert;

class ResetPassword
{
    #[Assert\PasswordStrength(
        minScore: Assert\PasswordStrength::STRENGTH_STRONG
    )]
    #[Assert\NotCompromisedPassword()]
    #[Assert\Length(min: 12)]
    public string $password;

    public function __construct(
        public readonly int $userId
    ) {
    }
}
