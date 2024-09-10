<?php

namespace App\Controller\User\Admin;

use App\Entity\User\User;
use App\Message\User\EnableUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class EnableUserController extends AbstractController
{
    #[Route('/admin/users/{user}/enable', name: 'user_enable')]
    public function __invoke(
        User $user,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    ): Response {
        $bus->dispatch(new EnableUser($user));

        $this->addFlash(
            'success',
            $translator->trans('User successfully enabled.')
        );

        return $this->redirectToRoute('user_overview');
    }
}
