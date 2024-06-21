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

class ForgotPasswordController extends AbstractController
{
    #[Route('/password-reset', name: 'forgot_password')]
    public function __invoke(
        Request $request,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    ): Response {
        $form = $this->createForm(ForgotPasswordType::class, new SendPasswordReset());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bus->dispatch($form->getData());
        }

        return $this->render('user/forgot.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
