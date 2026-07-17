<?php

declare(strict_types=1);

namespace App\Message\User;

use App\Validator\User\UniqueEmail;
use Symfony\Component\Validator\Constraints as Assert;

final class ChangeEmail
{
    public function __construct(
        public readonly int $userId,
        /**
         * @var non-empty-string $email
         */
        // @phpstan-ignore parameter.defaultValue
        #[Assert\NotBlank]
        #[Assert\Email]
        #[UniqueEmail]
        // @mago-expect analysis:invalid-parameter-default-value
        public string $email = '',
    ) {
    }
}
