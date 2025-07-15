<?php

namespace App\Security;

use App\Entity\User\User;
use App\Repository\User\UserRepository;
use App\Security\Exception\UnconfirmedAccountException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class UserChecker implements UserCheckerInterface
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly RouterInterface $router,
        private readonly UserRepository $userRepository
    ) {
    }

    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        if (!$user->isConfirmed()) {
            throw new UnconfirmedAccountException(
                $this->translator->trans(
                    'Account has not been confirmed. <a href="{resendConfirmationUrl}">Resend confirmation mail</a>',
                    [
                        'resendConfirmationUrl' => $this->router->generate(
                            'user_resend_confirmation',
                            [
                                'token' => $user->getConfirmationToken(),
                            ]
                        ),
                    ]
                )
            );
        }

        if (!$user->isEnabled()) {
            throw new DisabledException('This account has been disabled.');
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        if ($user->getPasswordResetToken() !== null) {
            $user->erasePasswordResetRequest();

            $this->userRepository->save();
        }
    }
}
