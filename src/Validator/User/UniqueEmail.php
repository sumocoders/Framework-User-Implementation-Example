<?php

namespace App\Validator\User;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    public string $message = 'The email "{{ string }}" is already in use.';
}