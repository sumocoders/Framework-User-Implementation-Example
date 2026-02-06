<?php

namespace App\Controller\User\Admin;

use App\Entity\User\User;
use App\Form\User\Admin\UserType;
use App\Form\User\Disable2FaType;
use App\Message\User\Disable2Fa;
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

#[Route('/admin/users/{user}/edit', name: 'user_admin_edit')]
class EditUserController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private MessageBusInterface $messageBus
    ) {
    }

    #[Breadcrumb('edit', parent: ['name' => 'user_admin_overview'])]
    public function __invoke(User $user, Request $request): Response
    {
        $form = $this->createForm(UserType::class, new UpdateUser($user));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageBus->dispatch($form->getData());

            $this->addFlash(
                'success',
                $this->translator->trans('User successfully edited.')
            );

            return $this->redirectToRoute('user_admin_overview');
        }

        $sendPasswordResetMessage = new SendPasswordReset();
        $sendPasswordResetMessage->email = $user->getEmail();
        $passwordForgotForm = $this->createForm(FormType::class, $sendPasswordResetMessage);
        $passwordForgotForm->handleRequest($request);

        if ($passwordForgotForm->isSubmitted() && $passwordForgotForm->isValid()) {
            $this->messageBus->dispatch($sendPasswordResetMessage);

            $this->addFlash(
                'success',
                $this->translator->trans('Password reset successfully sent.')
            );

            return $this->redirectToRoute('user_admin_edit', ['user' => $user->getId()]);
        }

        $disable2FaMessage = new Disable2Fa($user);
        $disable2FaForm = $this->createForm(Disable2FaType::class, $disable2FaMessage);
        $disable2FaForm->handleRequest($request);

        if ($disable2FaForm->isSubmitted() && $disable2FaForm->isValid()) {
            $this->messageBus->dispatch($disable2FaMessage);

            $this->addFlash(
                'success',
                $this->translator->trans('2FA disabled')
            );

            return $this->redirectToRoute('user_admin_edit', ['user' => $user->getId()]);
        }

        return $this->render('user/admin/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'passwordForgotForm' => $passwordForgotForm,
            'disable2FaForm' => $disable2FaForm,
        ]);
    }
}
