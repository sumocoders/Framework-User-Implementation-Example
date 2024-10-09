<?php

namespace App\Controller\User\Admin;

use App\Entity\User\User;
use App\Form\User\Admin\UserType;
use App\Message\User\SendPasswordReset;
use App\Message\User\UpdateUser;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class EditUserController extends AbstractController
{
    #[Route('/admin/users/{user}/edit', name: 'user_edit')]
    #[Breadcrumb('edit', parent:['name' => 'user_overview'])]
    public function __invoke(
        User $user,
        Request $request,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    ): Response {
        $form = $this->createForm(UserType::class, new UpdateUser($user));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bus->dispatch($form->getData());

            $this->addFlash(
                'success',
                $translator->trans('User successfully edited.')
            );

            return $this->redirectToRoute('user_overview');
        }

        $sendPasswordResetMessage = new SendPasswordReset();
        $sendPasswordResetMessage->email = $user->getEmail();
        $passwordForgotForm = $this->createForm(FormType::class, $sendPasswordResetMessage);
        $passwordForgotForm->handleRequest($request);

        if ($passwordForgotForm->isSubmitted() && $passwordForgotForm->isValid()) {
            $bus->dispatch($sendPasswordResetMessage);

            $this->addFlash(
                'success',
                $translator->trans('Password reset successfully sent.')
            );

            return $this->redirectToRoute('user_edit', ['user' => $user->getId()]);
        }

        return $this->render('user/admin/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'passwordForgotForm' => $passwordForgotForm,
        ]);
    }
}
