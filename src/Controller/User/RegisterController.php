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

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function __invoke(
        Request $request,
        SessionInterface $session,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    ): Response {
        $form = $this->createForm(RegisterType::class, new RegisterUser());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bus->dispatch($form->getData());
        }

        return $this->render('user/register.html.twig', [
            'form' => $form,
        ]);
    }
}
