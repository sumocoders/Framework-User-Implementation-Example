<?php

namespace App\Validator\User;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class UserTotpCode extends Constraint
{
    public string $message = 'The verification code is not valid.';
}
