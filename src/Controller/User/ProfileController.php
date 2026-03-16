<?php

namespace App\Controller\User;

use App\Entity\User\User;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Message\User\ChangeEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Form\User\ChangeEmailType;

#[Route('/user/profile', name: 'user_profile')]
class ProfileController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly MessageBusInterface $messageBus,
    ) {
    }

    #[Breadcrumb('Email')]
    public function __invoke(
        Request $request,
        #[CurrentUser] User $user
    ): Response {
        $message = new ChangeEmail($user->getId(), $user->getEmail());

        $form = $this->createForm(ChangeEmailType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageBus->dispatch($form->getData());

            $this->addFlash(
                'success',
                $this->translator->trans('Email successfully edited.')
            );

            return $this->redirectToRoute('user_profile');
        }

        return $this->render('user/profile/email.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
