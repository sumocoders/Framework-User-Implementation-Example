<?php

namespace App\Controller\User;

use App\Form\User\Admin\ChangePasswordType;
use App\Message\User\ChangePassword;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
  public function __invoke(
    Request $request,
    SessionInterface $session,
    TranslatorInterface $translator
  ): Response {
    $form = $this->createForm(ChangePasswordType::class, new ChangePassword($this->getUser()));

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->dispatchMessage($form->getData());

      $session->getBag('flashes')->add(
        'success',
        $translator->trans('Password successfully edited.')
      );
    }

    return $this->render('user/profile.html.twig', [
      'user' => $this->getUser(),
      'form' => $form->createView(),
    ]);
  }
}
