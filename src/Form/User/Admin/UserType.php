<?php

namespace App\Form\User\Admin;

use App\ValueObject\User\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

final class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Email'
                ]
            )
            ->add(
                'roles',
                ChoiceType::class,
                [
                    'label' => 'Roles',
                    'choices' => Role::getChoices(),
                    'multiple' => true,
                    'expanded' => true,
                ]
            )
        ;
    }
}
