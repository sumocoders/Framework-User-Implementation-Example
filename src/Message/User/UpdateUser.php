<?php

namespace App\Message\User;

use App\DataTransferObject\User\UserDataTransferObject;
use App\Entity\User\User;

class UpdateUser extends UserDataTransferObject
{
    public readonly int $userId;

    public function __construct(
        User $user
    ) {
        $this->userId = $user->getId();
        $this->email = $user->getEmail();
        $this->roles = $user->getRoles();
    }
}
