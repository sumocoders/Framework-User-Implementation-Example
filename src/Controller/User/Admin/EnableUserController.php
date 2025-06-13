<?php

namespace App\Controller\User\Admin;

use App\Entity\User\User;
use App\Message\User\EnableUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @method User getUser()
 */
class EnableUserController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private MessageBusInterface $messageBus
    ) {
    }

    #[Route('/admin/users/{user}/enable', name: 'user_enable')]
    public function __invoke(User $user): Response
    {
        if ($user->getId() === $this->getUser()->getId()) {
            throw $this->createAccessDeniedException();
        }

        $this->messageBus->dispatch(new EnableUser($user));

        $this->addFlash(
            'success',
            $this->translator->trans('User successfully enabled.')
        );

        return $this->redirectToRoute('user_overview');
    }
}
