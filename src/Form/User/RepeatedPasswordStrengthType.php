<?php

namespace App\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<RepeatedType>
 */
final class RepeatedPasswordStrengthType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('type', PasswordType::class);
        $resolver->setDefault(
            'first_options',
            [
                'label' => 'Password',
                'attr' => [
                    'autocomplete' => 'new-password',
                ],
            ]
        );
        $resolver->setDefault(
            'second_options',
            [
                'label' => 'Confirm password',
                'attr' => [
                    'autocomplete' => 'new-password',
                ],
            ]
        );
    }

    public function getParent(): string
    {
        return RepeatedType::class;
    }
}
