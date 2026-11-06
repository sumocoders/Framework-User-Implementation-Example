<?php

namespace App\Message\User;

use App\Entity\User\User;
use Symfony\Component\Form\Attribute\AsFormType;

#[AsFormType]
final readonly class Disable2Fa
{
    public function __construct(
        public User $user,
    ) {
    }
}
