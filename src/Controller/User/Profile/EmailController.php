<?php

declare(strict_types=1);

namespace App\Controller\User\Profile;

use App\Entity\User\User;
use App\Form\User\ChangeEmailType;
use App\Message\User\ChangeEmail;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/user/email', name: 'user_email')]
class EmailController extends AbstractController
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

            return $this->redirectToRoute('user_email');
        }

        return $this->render('user/profile/email.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
