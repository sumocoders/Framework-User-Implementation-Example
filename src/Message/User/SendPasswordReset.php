<?php

namespace App\Message\User;

use Symfony\Component\Validator\Constraints as Assert;

class SendPasswordReset
{
    /**
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    public ?string $email = null;
}