<?php

namespace App\Message\User;

use App\Form\User\RepeatedPasswordStrengthType;
use Symfony\Component\Form\Attribute\AsFormType;
use Symfony\Component\Form\Attribute\FormField;
use Symfony\Component\Validator\Constraints\NotBlank;

#[AsFormType]
class ChangePassword
{
    #[FormField(RepeatedPasswordStrengthType::class)]
    #[NotBlank]
    public string $password;

    public function __construct(
        public readonly int $userId,
    ) {
    }
}
