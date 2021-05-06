<?php

namespace App\Validator\User;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    public string $message = '%email% is already in use.';
}