<?php

namespace App\Controller\User\Profile;

use App\Entity\User\User;
use App\Form\User\Admin\ChangePasswordType;
use App\Message\User\ChangePassword;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/user/password', name: 'user_password')]
class PasswordController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private MessageBusInterface $messageBus
    ) {
    }

    #[Breadcrumb('user_password')]
    public function __invoke(
        Request $request,
        #[CurrentUser] User $user
    ): Response {
        $form = $this->createForm(ChangePasswordType::class, new ChangePassword($user->getId()));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageBus->dispatch($form->getData());

            $this->addFlash(
                'success',
                $this->translator->trans('Password successfully edited.')
            );
        }

        return $this->render('user/profile/password.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
