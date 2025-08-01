<?php

namespace App\Validator\User;

use App\Entity\User\User;
use App\Message\User\CreateUser;
use App\Message\User\RegisterUser;
use App\Message\User\UpdateUser;
use App\Repository\User\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniqueEmailValidator extends ConstraintValidator
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueEmail) {
            throw new UnexpectedTypeException($constraint, UniqueEmail::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        $userWithThatEmail = $this->userRepository->findOneBy(['email' => $value]);

        $formData = $this->context->getObject();

        /*
         * If we're adding a new user (either through the back-end or register page),
         * throw an error if we can find an existing user with the same email address.
         */
        if (
            ($formData instanceof CreateUser || $formData instanceof RegisterUser)
            && $userWithThatEmail instanceof User
        ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%email%', $value)
                ->addViolation();
        }

        /*
         * If we're updating an existing user, only throw an error if we the user we're updating
         * isn't the one we found in the database.
         */
        if (
            $formData instanceof UpdateUser
            && $userWithThatEmail instanceof User
            && $formData->user->getId() !== $userWithThatEmail->getId()
        ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%email%', $value)
                ->addViolation();
        }
    }
}
