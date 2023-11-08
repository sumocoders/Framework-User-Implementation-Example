<?php

namespace App\Controller\User\Admin;

use App\DataTransferObject\User\FilterDataTransferObject;
use App\Form\User\Admin\FilterType;
use App\Repository\User\UserRepository;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

class OverviewController extends AbstractController
{
    #[Route('/admin/users', name: 'user_overview')]
    #[Breadcrumb('users')]
    public function __invoke(
        Request $request,
        UserRepository $userRepository,
        #[MapQueryParameter]
        ?int $page = 1
    ): Response {
        $form = $this->createForm(
            FilterType::class,
            new FilterDataTransferObject()
        );

        $form->handleRequest($request);

        $paginatedUsers = $userRepository->getAllFilteredUsers($form->getData());

        $paginatedUsers->paginate($page);

        return $this->render('user/admin/overview.html.twig', [
            'form' => $form->createView(),
            'users' => $paginatedUsers,
        ]);
    }
}
