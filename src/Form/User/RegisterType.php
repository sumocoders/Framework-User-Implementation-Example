<?php

declare(strict_types=1);

namespace App\Form\User;

use App\DataTransferObject\User\UserDataTransferObject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @template TData of UserDataTransferObject
 * @extends AbstractType<TData>
 */
final class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Email',
                ]
            )
            ->add(
                'password',
                RepeatedPasswordStrengthType::class
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', UserDataTransferObject::class);
    }
}
