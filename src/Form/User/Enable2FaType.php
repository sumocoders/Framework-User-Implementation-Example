<?php

namespace App\Form\User;

use App\Message\User\Enable2Fa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<Enable2Fa>
 */
class Enable2FaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'code',
            TextType::class,
            [
                'label' => 'Code',
                'attr' => [
                    'autocomplete' => 'one-time-code',
                    'autofocus' => true,
                    'inputmode' => 'numeric',
                    'pattern' => '[0-9]*',
                    'placeholder' => 'Enter the code from your authenticator app',
                ],
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Enable2Fa::class);
    }
}
