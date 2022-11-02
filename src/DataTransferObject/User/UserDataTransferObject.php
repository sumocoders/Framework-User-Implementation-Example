<?php

namespace App\DataTransferObject\User;

use App\Validator\User\UniqueEmail;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserDataTransferObject
{
    #[Email]
    #[NotBlank]
    #[UniqueEmail]
    public string $email;

    /**
     * @var array<int, string> $roles
     */
    public array $roles = [];
}
