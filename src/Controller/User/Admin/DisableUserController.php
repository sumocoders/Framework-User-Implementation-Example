<?php

namespace App\Controller\User\Admin;

use App\Entity\User\User;
use App\Message\User\DisableUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @method User getUser()
 */
class DisableUserController extends AbstractController
{
    #[Route('/admin/users/{user}/disable', name: 'user_disable')]
    public function __invoke(
        User $user,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    ): Response {
        if ($user->getId() === $this->getUser()->getId()) {
            throw $this->createAccessDeniedException();
        }

        $bus->dispatch(new DisableUser($user));

        $this->addFlash(
            'success',
            $translator->trans('User successfully disabled.')
        );

        return $this->redirectToRoute('user_overview');
    }
}
