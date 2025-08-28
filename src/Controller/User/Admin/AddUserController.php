<?php

namespace App\Controller\User\Admin;

use App\Form\User\Admin\UserType;
use App\Message\User\CreateUser;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/admin/users/add', name: 'user_admin_add')]
class AddUserController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private MessageBusInterface $messageBus
    ) {
    }

    #[Breadcrumb('add', parent: ['name' => 'user_admin_overview'])]
    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(UserType::class, new CreateUser());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();
            // @phpstan-ignore-next-line property.notFound
            $message->locale = $request->getLocale();
            $this->messageBus->dispatch($message);

            $this->addFlash(
                'success',
                $this->translator->trans('User successfully added.')
            );

            return $this->redirectToRoute('user_admin_overview');
        }

        return $this->render('user/admin/add.html.twig', [
            'form' => $form,
        ]);
    }
}
