<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Form\User\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/login', name: 'login')]
class LoginController extends AbstractController
{
    public function __construct(
        private readonly AuthenticationUtils $authenticationUtils
    ) {
    }

    public function __invoke(): Response
    {
        if ($this->getUser() instanceof User) {
            return $this->redirectToRoute('profile');
        }

        $form = $this->createForm(LoginType::class, [
            'email' => $this->authenticationUtils->getLastUsername(),
        ]);

        return $this->render('user/login.html.twig', [
            'error' => $this->authenticationUtils->getLastAuthenticationError(),
            'last_username' => $this->authenticationUtils->getLastUsername(),
            'form' => $form,
        ]);
    }
}
