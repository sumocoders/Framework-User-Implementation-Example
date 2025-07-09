<?php

namespace App\Form\User\Admin;

use App\Message\User\ConfirmUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<ConfirmUser>
 */
class ConfirmType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConfirmUser::class,
        ]);
    }
}
