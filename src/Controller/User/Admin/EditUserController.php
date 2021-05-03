<?php

namespace App\Controller\User\Admin;

use App\Entity\User\User;
use App\Form\User\Admin\UserType;
use App\Message\User\UpdateUser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class EditUserController extends AbstractController
{
    /**
     * @Route("/admin/users/{user}/edit", name="user_edit")
     */
    public function __invoke(
        User $user,
        Request $request,
        SessionInterface $session,
        TranslatorInterface $translator
    ): Response {
        $form = $this->createForm(UserType::class, new UpdateUser($user));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->dispatchMessage($form->getData());

            $session->getBag('flashes')->add(
                'success',
                $translator->trans('User successfully edited.')
            );

            return $this->redirectToRoute('user_overview');
        }

        return $this->render('user/admin/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
