<?php

namespace App\DataTransferObject\User;

use Symfony\Component\Form\Attribute\AsFormType;
use Symfony\Component\Form\Attribute\FormField;
use Symfony\Component\Form\Extension\Core\Type\TextType;

#[AsFormType(['method' => 'GET', 'csrf_protection' => false])]
class FilterDataTransferObject
{
    #[FormField(TextType::class, [
        'label' => 'filter.term',
        'required' => false,
    ])]
    public ?string $term = null;
}
