<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Form\User\ResetPasswordType;
use App\Message\User\ResetPassword;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ResetPasswordController extends AbstractController
{
    #[Route('/password-reset/{token}', name: 'reset_password')]
    public function __invoke(
        string $token,
        Request $request,
        UserRepository $userRepository,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    ): Response {
        $user = $userRepository->checkResetToken($token);

        if (!$user instanceof User) {
            $this->addFlash(
                'error',
                $translator->trans('It looks like you clicked on an invalid password reset link. Please try again.')
            );

            return $this->redirectToRoute(ForgotPasswordController::class);
        }

        $form = $this->createForm(ResetPasswordType::class, new ResetPassword($user));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bus->dispatch($form->getData());

            $this->addFlash(
                'success',
                $translator->trans('New password set successfully.')
            );

            return $this->redirectToRoute(LoginController::class);
        }

        return $this->render('user/reset.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
