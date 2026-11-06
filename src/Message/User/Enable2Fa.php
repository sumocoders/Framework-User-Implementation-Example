<?php

namespace App\Message\User;

use App\Entity\User\User;
use App\Validator\User\UserTotpCode;
use Symfony\Component\Form\Attribute\AsFormType;
use Symfony\Component\Form\Attribute\FormField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

#[AsFormType]
final class Enable2Fa
{
    #[FormField(TextType::class, [
        'attr' => [
            'autocomplete' => 'one-time-code',
            'autofocus' => true,
            'inputmode' => 'numeric',
            'pattern' => '[0-9]*',
            'placeholder' => 'Enter the code from your authenticator app',
        ],
    ])]
    #[NotBlank]
    #[UserTotpCode]
    public ?string $code = null;

    public function __construct(
        public readonly User $user,
        #[\SensitiveParameter]
        public readonly string $secret,
    ) {
    }
}
