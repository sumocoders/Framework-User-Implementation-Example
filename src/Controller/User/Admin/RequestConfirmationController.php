<?php

namespace App\Controller\User\Admin;

use App\Entity\User\User;
use App\Message\User\SendConfirmation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RequestConfirmationController extends AbstractController
{
    #[Route('/admin/users/{user}/request-confirmation', name: 'request_confirmation_admin')]
    public function __invoke(
        User $user,
        TranslatorInterface $translator
    ): Response {
        if ($user->isConfirmed()) {
            $this->addFlash(
                'error',
                $translator->trans('User is already confirmed.')
            );

            $this->redirectToRoute('user_edit', ['user' => $user->getId()]);
        }

        $this->dispatchMessage(new SendConfirmation($user));

        $this->addFlash(
            'success',
            $translator->trans('Confirmation mail successfully sent')
        );

        return $this->redirectToRoute('user_edit', ['user' => $user->getId()]);
    }
}
