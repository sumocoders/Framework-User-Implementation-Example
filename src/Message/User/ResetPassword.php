<?php

namespace App\Message\User;

use App\Entity\User\User;
use Symfony\Component\Validator\Constraints as Assert;

class ResetPassword
{
    #[Assert\PasswordStrength([
        'minScore' => Assert\PasswordStrength::STRENGTH_STRONG,
    ])]
    #[Assert\NotCompromisedPassword()]
    #[Assert\Length(min: 12)]
    public string $password;

    public function __construct(private readonly User $user)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
