<?php

namespace App\Message\User;

use App\DataTransferObject\User\UserDataTransferObject;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser extends UserDataTransferObject
{
    /**
     * @Assert\NotBlank()
     */
    public string $password;
}
