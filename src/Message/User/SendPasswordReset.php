<?php

namespace App\Message\User;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class SendPasswordReset
{
    #[Email]
    #[NotBlank]
    public ?string $email = null;
}
