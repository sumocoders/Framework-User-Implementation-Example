<?php

namespace App\Message\User;

use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePassword
{
    #[NotBlank]
    public string $password;

    public function __construct(
        public readonly int $userId
    ) {
    }
}
