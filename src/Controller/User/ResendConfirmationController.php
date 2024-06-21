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

final class ResendConfirmationController extends AbstractController
{
    #[Route('/resend-confirmation/{token}')]
    public function __invoke(
        string $token,
        UserRepository $userRepository,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    ): Response {
        $user = $userRepository->findOneBy(['confirmationToken' => $token]);

        if (!$user instanceof User) {
            $this->addFlash(
                'error',
                $translator->trans('Invalid confirmation token.')
            );

            return $this->redirectToRoute(LoginController::class);
        }

        $bus->dispatch(new SendConfirmation($user));

        $this->addFlash('success', $translator->trans('Confirmation mail successfully resent'));

        return $this->redirectToRoute(LoginController::class);
    }
}
