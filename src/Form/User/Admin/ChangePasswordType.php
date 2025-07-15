<?php

namespace App\Form\User\Admin;

use App\Form\User\RepeatedPasswordStrengthType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @template TData of FormBuilderInterface
 * @extends AbstractType<TData>
 */
final class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'password',
                RepeatedPasswordStrengthType::class
            );
    }
}
