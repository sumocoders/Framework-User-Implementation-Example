<?php

namespace App\Message\User;

use App\Form\User\RepeatedPasswordStrengthType;
use Symfony\Component\Form\Attribute\AsFormType;
use Symfony\Component\Form\Attribute\FormField;
use Symfony\Component\Validator\Constraints as Assert;

#[AsFormType]
class ResetPassword
{
    #[FormField(RepeatedPasswordStrengthType::class)]
    #[Assert\PasswordStrength(
        minScore: Assert\PasswordStrength::STRENGTH_STRONG,
    )]
    #[Assert\NotCompromisedPassword]
    #[Assert\Length(min: 12)]
    public string $password;

    public function __construct(
        public readonly int $userId,
    ) {
    }
}
