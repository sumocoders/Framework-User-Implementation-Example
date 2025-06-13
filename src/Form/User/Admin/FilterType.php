<?php

namespace App\Form\User\Admin;

use App\DataTransferObject\User\FilterDataTransferObject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @template TData of FilterDataTransferObject
 * @extends AbstractType<TData>
 */
class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'term',
                TextType::class,
                [
                    'label' => 'filter.term',
                    'required' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', FilterDataTransferObject::class);
    }
}
