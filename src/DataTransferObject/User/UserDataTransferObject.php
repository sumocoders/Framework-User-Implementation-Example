<?php

namespace App\DataTransferObject\User;

use App\Validator\User\UniqueEmail;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NoSuspiciousCharacters;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserDataTransferObject
{
    /**
     * @var non-empty-string $email
     */
    #[Email]
    #[NotBlank]
    #[UniqueEmail]
    #[NoSuspiciousCharacters]
    public string $email;

    /**
     * @var array<array-key, string> $roles
     */
    public array $roles = [];

    public string $locale;
}
