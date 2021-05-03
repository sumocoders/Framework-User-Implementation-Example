<?php

namespace App\Controller\User\Admin;

use App\Entity\User\User;
use App\Message\User\DisableUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class DisableUserController extends AbstractController
{
    /**
     * @Route("/admin/users/{user}/disable", name="user_disable")
     */
    public function __invoke(
        User $user,
        SessionInterface $session,
        TranslatorInterface $translator
    ): Response {
        $this->dispatchMessage(new DisableUser($user));

        $session->getBag('flashes')->add(
            'success',
            $translator->trans('User successfully disabled.')
        );

        return $this->redirectToRoute('user_edit', ['user' => $user->getId()]);
    }
}
