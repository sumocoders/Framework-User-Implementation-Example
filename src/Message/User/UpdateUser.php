<?php

namespace App\Message\User;

use App\DataTransferObject\User\UserDataTransferObject;
use App\Entity\User\User;

class UpdateUser extends UserDataTransferObject
{
    public function __construct(private readonly User $user)
    {
        $this->email = $user->getEmail();
        $this->roles = $user->getRoles();
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
