<?php

declare(strict_types=1);

namespace App\Message\User;

use App\Validator\User\UniqueEmail;
use Symfony\Component\Validator\Constraints as Assert;

final class ChangeEmail
{
    public function __construct(
        public readonly int $userId,
        #[Assert\NotBlank]
        #[Assert\Email]
        #[UniqueEmail]
        public string $email = '',
    ) {
    }
}
