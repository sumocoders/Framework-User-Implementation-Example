<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Message\User\ConfirmUser;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ConfirmController extends AbstractController
{
    /**
     * @Route("/confirm/{token}", name="confirm")
     */
    public function __invoke(
        string $token,
        SessionInterface $session,
        UserRepository $userRepository,
        TranslatorInterface $translator
    ): Response {
        $user = $userRepository->checkConfirmationToken($token);

        if (!$user instanceof User) {
            $session->getBag('flashes')->add(
                'error',
                $translator->trans('It looks like you clicked on an invalid account activation link. Please try again.')
            );

            return $this->redirectToRoute('login');
        }

        $this->dispatchMessage(new ConfirmUser($user));

        $session->getBag('flashes')->add(
            'success',
            $translator->trans('Account activated successfully.')
        );

        /*
         * When a new user is created from the back-end, he has to both
         * confirm his account and set a password, so we redirect them straight
         * to the password reset page after confirming.
         */
        if ($user->getPasswordResetToken() !== null) {
            $this->redirectToRoute('reset_password', ['token' => $user->getPasswordResetToken()]);
        }

        return $this->redirectToRoute('login');
    }
}
