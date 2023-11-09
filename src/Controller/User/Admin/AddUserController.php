<?php

namespace App\Controller\User\Admin;

use App\Form\User\Admin\UserType;
use App\Message\User\CreateUser;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class AddUserController extends AbstractController
{
    #[Route('/admin/users/add')]
    #[Breadcrumb('add', parent:['name' => 'app_user_admin_overview'])]
    public function __invoke(
        Request $request,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    ): Response {
        $form = $this->createForm(UserType::class, new CreateUser());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bus->dispatch($form->getData());

            $this->addFlash(
                'success',
                $translator->trans('User successfully added.')
            );

            return $this->redirectToRoute(OverviewController::class);
        }

        return $this->render('user/admin/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
