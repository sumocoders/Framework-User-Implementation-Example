<?php

namespace App\Form\User\Admin;

use App\Form\User\RepeatedPasswordStrengthType;
use App\Message\User\ChangePassword;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @extends AbstractType<ChangePassword>
 */
final class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'password',
                RepeatedPasswordStrengthType::class,
            );
    }
}
