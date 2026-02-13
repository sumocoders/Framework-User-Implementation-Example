<?php

namespace App\Controller\User;

use App\Form\User\RegisterType;
use App\Message\User\RegisterUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/user/register', name: 'user_register')]
class RegisterController extends AbstractController
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {
    }

    public function __invoke(Request $request, SessionInterface $session): Response
    {
        $registerUser = new registerUser();
        $registerUser->locale = $request->getLocale();
        $form = $this->createForm(RegisterType::class, $registerUser);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageBus->dispatch($form->getData());

            return $this->redirectToRoute('user_register', [
                'success' => true,
            ]);
        }

        return $this->render('user/register.html.twig', [
            'form' => $form,
            'show_registered_message' => $request->query->getBoolean('success', false),
        ]);
    }
}
