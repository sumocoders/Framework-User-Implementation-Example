<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Form\User\Admin\ChangePasswordType;
use App\Message\User\ChangePassword;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    #[Breadcrumb('profile')]
    public function __invoke(
        Request $request,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    ): Response {
        if (!$this->getUser() instanceof User) {
            throw new \RuntimeException('Invalid user object');
        }

        $form = $this->createForm(ChangePasswordType::class, new ChangePassword($this->getUser()));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bus->dispatch($form->getData());

            $this->addFlash(
                'success',
                $translator->trans('Password successfully edited.')
            );
        }

        return $this->render('user/profile.html.twig', [
            'user' => $this->getUser(),
            'form' => $form,
        ]);
    }
}
