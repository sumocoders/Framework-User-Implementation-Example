<?php

namespace App\Validator\User;

use App\Message\User\Enable2Fa;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class UserTotpCodeValidator extends ConstraintValidator
{
    public function __construct(
        private readonly TotpAuthenticatorInterface $totpAuthenticator,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof UserTotpCode) {
            throw new UnexpectedTypeException($constraint, UserTotpCode::class);
        }
        if (null === $value || '' === $value) {
            return;
        }

        /**
         * @var Enable2Fa $message
         */
        $message = $this->context->getObject();
        $user = $message->user;
        // store it temporarily in the user object so the totpAuthenticator can use it to check the code
        $user->setTotpSecret($message->secret);

        if ($this->totpAuthenticator->checkCode($user, $value)) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->addViolation();
    }
}
