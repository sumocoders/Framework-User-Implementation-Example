<?php

namespace App\Message\User;

use App\DataTransferObject\User\UserDataTransferObject;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterUser extends UserDataTransferObject
{
    #[NotBlank]
    #[Assert\PasswordStrength(
        minScore: Assert\PasswordStrength::STRENGTH_STRONG
    )]
    #[Assert\NotCompromisedPassword()]
    #[Assert\Length(min: 12)]
    public string $password;
}
