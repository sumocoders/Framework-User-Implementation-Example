<?php

namespace App\Message\User;

use App\DataTransferObject\User\UserDataTransferObject;
use App\Entity\User\User;

class UpdateUser extends UserDataTransferObject
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->email = $user->getEmail();
        $this->roles = $user->getRoles();
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
