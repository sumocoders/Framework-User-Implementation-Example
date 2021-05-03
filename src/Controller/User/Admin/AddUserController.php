<?php

namespace App\Controller\User\Admin;

use App\Form\User\Admin\UserType;
use App\Message\User\CreateUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class AddUserController extends AbstractController
{
    /**
     * @Route("/admin/users/add", name="user_add")
     */
    public function __invoke(
        Request $request,
        SessionInterface $session,
        TranslatorInterface $translator
    ): Response {
        $form = $this->createForm(UserType::class, new CreateUser());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->dispatchMessage($form->getData());

            $session->getBag('flashes')->add(
                'success',
                $translator->trans('User successfully added.')
            );

            return $this->redirectToRoute('user_overview');
        }

        return $this->render('user/admin/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
