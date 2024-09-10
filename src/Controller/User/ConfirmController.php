<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Form\User\Admin\ConfirmType;
use App\Message\User\ConfirmUser;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ConfirmController extends AbstractController
{
    #[Route('/confirm/{token}', name: 'confirm')]
    public function __invoke(
        string $token,
        UserRepository $userRepository,
        TranslatorInterface $translator,
        MessageBusInterface $bus,
        Request $request
    ): Response {
        $user = $userRepository->checkConfirmationToken($token);

        if (!$user instanceof User) {
            $this->addFlash(
                'error',
                $translator->trans('It looks like you clicked on an invalid account activation link. Please try again.')
            );

            return $this->redirectToRoute('login');
        }

        $confirmForm = $this->createForm(ConfirmType::class, new ConfirmUser($user));
        $confirmForm->handleRequest($request);

        if ($confirmForm->isSubmitted() && $confirmForm->isValid()) {
            $bus->dispatch(new ConfirmUser($user));

            $this->addFlash(
                'success',
                $translator->trans('Account activated successfully.')
            );

            /*
             * When a new user is created from the back-end, the user has to confirm and set a password.
             * Therefore the user is redirected to the set password page after confirming.
             */
            if ($user->getPasswordResetToken() !== null) {
                return $this->redirectToRoute(
                    'reset_password',
                    ['token' => $user->getPasswordResetToken()]
                );
            }

            return $this->redirectToRoute('login');
        }

        return $this->render('user/confirm.html.twig', [
            'form' => $confirmForm->createView(),
        ]);
    }
}
