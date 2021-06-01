<?php

namespace App\Controller\User;

use App\Form\User\Admin\ChangePasswordType;
use App\Message\User\ChangePassword;
use SumoCoders\FrameworkCoreBundle\Annotation\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     * @Breadcrumb("profile")
     */
    public function __invoke(
        Request $request,
        TranslatorInterface $translator
    ): Response {
        $form = $this->createForm(ChangePasswordType::class, new ChangePassword($this->getUser()));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->dispatchMessage($form->getData());

            $this->addFlash(
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
