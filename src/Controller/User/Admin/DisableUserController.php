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
#[Route('/admin/users/{user}/disable', name: 'user_admin_disable_user')]
class DisableUserController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private MessageBusInterface $messageBus
    ) {
    }

    public function __invoke(User $user): Response
    {
        if ($user->getId() === $this->getUser()->getId()) {
            throw $this->createAccessDeniedException();
        }

        $this->messageBus->dispatch(new DisableUser($user));

        $this->addFlash(
            'success',
            $this->translator->trans('User successfully disabled.')
        );

        return $this->redirectToRoute('user_admin_overview');
    }
}
