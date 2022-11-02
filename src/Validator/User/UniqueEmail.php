<?php

namespace App\Validator\User;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class UniqueEmail extends Constraint
{
    public string $message = '%email% is already in use.';
}
