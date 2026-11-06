<?php

declare(strict_types=1);

namespace App\Message\User;

use App\Validator\User\UniqueEmail;
use Symfony\Component\Form\Attribute\AsFormType;
use Symfony\Component\Form\Attribute\FormField;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints as Assert;

#[AsFormType]
final class ChangeEmail
{
    public function __construct(
        public readonly int $userId,
        /**
         * @var non-empty-string $email
         */
        // @phpstan-ignore parameter.defaultValue
        #[FormField(EmailType::class)]
        #[Assert\NotBlank]
        #[Assert\Email]
        #[UniqueEmail]
        // @mago-expect analysis:invalid-parameter-default-value
        public string $email = '',
    ) {
    }
}
