<?php

namespace App\Message\User;

use Symfony\Component\Form\Attribute\AsFormType;
use Symfony\Component\Form\Attribute\FormField;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

#[AsFormType]
class SendPasswordReset
{
    public function __construct(
        #[FormField(EmailType::class, [
            'attr' => [
                'tabindex' => 1,
                'autocomplete' => 'username',
            ],
        ])]
        #[Email]
        #[NotBlank]
        public ?string $email = null,
    ) {
    }
}
