<?php

namespace App\Message\User;

use App\Entity\User\User;
use App\Validator\User\UserTotpCode;
use Symfony\Component\Validator\Constraints\NotBlank;

final class Enable2Fa
{
    #[NotBlank]
    #[UserTotpCode]
    public ?string $code = null;

    public function __construct(
        public readonly User $user,
        public readonly string $secret,
    ) {
    }
}
