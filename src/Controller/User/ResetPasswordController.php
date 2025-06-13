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
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly TranslatorInterface $translator,
        private MessageBusInterface $bus
    ) {
    }

    #[Route('/password-reset/{token}', name: 'reset_password')]
    public function __invoke(string $token, Request $request): Response
    {
        $user = $this->userRepository->checkResetToken($token);

        if (!$user instanceof User) {
            $this->addFlash(
                'error',
                $this->translator->trans(
                    'It looks like you clicked on an invalid password reset link. Please try again.'
                )
            );

            return $this->redirectToRoute('forgot_password');
        }

        $form = $this->createForm(ResetPasswordType::class, new ResetPassword($user));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bus->dispatch($form->getData());

            $this->addFlash(
                'success',
                $this->translator->trans('New password set successfully.')
            );

            return $this->redirectToRoute('login');
        }

        return $this->render('user/reset.html.twig', [
            'form' => $form,
        ]);
    }
}
