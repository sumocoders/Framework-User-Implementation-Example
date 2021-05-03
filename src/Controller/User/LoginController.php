<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Form\User\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function __invoke(
        AuthenticationUtils $authenticationUtils
    ): Response {
        if ($this->getUser() instanceof User) {
            return $this->redirectToRoute('user_profile');
        }

        $form = $this->createForm(LoginType::class, [
            'email' => $authenticationUtils->getLastUsername(),
        ]);

        return $this->render('user/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername(),
            'form' => $form->createView(),
        ]);
    }
}
