<?php

namespace App\Form\User;

use App\Message\User\Disable2Fa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<Disable2Fa>
 */
class Disable2FaType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Disable2Fa::class);
    }
}
