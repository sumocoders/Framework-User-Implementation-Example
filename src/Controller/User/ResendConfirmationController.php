<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Message\User\SendConfirmation;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/user/resend-confirmation/{token}', name: 'user_resend_confirmation')]
final class ResendConfirmationController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly TranslatorInterface $translator,
        private MessageBusInterface $messageBus
    ) {
    }

    public function __invoke(string $token, Request $request): Response
    {
        $user = $this->userRepository->findOneBy(['confirmationToken' => $token]);

        if (!$user instanceof User) {
            $this->addFlash(
                'error',
                $this->translator->trans('Invalid confirmation token.')
            );

            return $this->redirectToRoute('login');
        }

        $this->messageBus->dispatch(new SendConfirmation($user, $request->getLocale()));

        $this->addFlash('success', $this->translator->trans('Confirmation mail successfully resent'));

        return $this->redirectToRoute('login');
    }
}
