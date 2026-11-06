<?php

namespace App\Message\User;

use Symfony\Component\Form\Attribute\AsFormType;

#[AsFormType]
readonly class ConfirmUser
{
    public function __construct(
        public int $userId,
    ) {
    }
}
