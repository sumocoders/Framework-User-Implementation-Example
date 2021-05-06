<?php

namespace App\Controller\User\Admin;

use App\Repository\User\UserRepository;
use SumoCoders\FrameworkCoreBundle\Annotation\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OverviewController extends AbstractController
{
    /**
     * @Route("/admin/users", name="user_overview")
     * @Breadcrumb("users")
     */
    public function __invoke(
        UserRepository $userRepository
    ): Response {
        return $this->render('user/admin/overview.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
}
