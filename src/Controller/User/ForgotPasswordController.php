<?php

namespace App\Controller\User;

use App\Form\User\ForgotPasswordType;
use App\Message\User\SendPasswordReset;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/password-reset', name: 'forgot_password')]
class ForgotPasswordController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private MessageBusInterface $messageBus
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(ForgotPasswordType::class, new SendPasswordReset());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageBus->dispatch($form->getData());

            $this->addFlash(
                'success',
                $this->translator->trans('Password reset link successfully sent.')
            );

            return $this->redirectToRoute('login');
        }

        return $this->render('user/forgot.html.twig', [
            'form' => $form,
        ]);
    }
}
