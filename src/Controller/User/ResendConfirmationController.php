<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Message\User\SendConfirmation;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ResendConfirmationController extends AbstractController
{
    /**
     * @Route("/resend-confirmation/{token}", name="resend_confirmation")
     */
    public function __invoke(
        string $token,
        SessionInterface $session,
        UserRepository $userRepository,
        TranslatorInterface $translator
    ): Response {
        $user = $userRepository->findOneBy(['confirmationToken' => $token]);

        if (!$user instanceof User) {
            $session->getBag('flashes')->add(
                'error',
                $translator->trans('Invalid confirmation token.')
            );

            return $this->redirectToRoute('login');
        }

        $this->dispatchMessage(new SendConfirmation($user));

        $session->getBag('flashes')->add('success', $translator->trans('Email confirmation mail successfully resent'));

        return $this->redirectToRoute('login');
    }
}
