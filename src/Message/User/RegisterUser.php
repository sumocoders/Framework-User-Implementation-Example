<?php

namespace App\Message\User;

use App\DataTransferObject\User\UserDataTransferObject;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterUser extends UserDataTransferObject
{
    #[NotBlank]
    public string $password;
}
