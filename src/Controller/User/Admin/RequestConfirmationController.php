<?php

namespace App\Controller\User\Admin;

use App\Entity\User\User;
use App\Message\User\SendConfirmation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RequestConfirmationController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private MessageBusInterface $bus
    ) {
    }

    #[Route('/admin/users/{user}/request-confirmation', name: 'request_confirmation')]
    public function __invoke(User $user): Response
    {
        if ($user->isConfirmed()) {
            $this->addFlash(
                'error',
                $this->translator->trans('User is already confirmed.')
            );

            $this->redirectToRoute('user_edit', ['user' => $user->getId()]);
        }

        $this->bus->dispatch(new SendConfirmation($user));

        $this->addFlash(
            'success',
            $this->translator->trans('Confirmation mail successfully sent')
        );

        return $this->redirectToRoute('user_edit', ['user' => $user->getId()]);
    }
}
