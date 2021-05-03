<?php

namespace App\Controller\User;

use App\Form\User\ForgotPasswordType;
use App\Message\User\SendPasswordReset;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ForgotPasswordController extends AbstractController
{
    /**
     * @Route("/password-reset", name="forgot_password")
     */
    public function __invoke(
        Request $request,
        SessionInterface $session,
        TranslatorInterface $translator
    ): Response {
        $form = $this->createForm(ForgotPasswordType::class, new SendPasswordReset());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->dispatchMessage($form->getData());;
        }

        return $this->render('user/forgot.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
