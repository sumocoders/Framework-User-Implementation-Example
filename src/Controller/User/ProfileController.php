<?php

namespace App\Controller\User;

use App\Entity\User\User;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/user/profile', name: 'user_profile')]
class ProfileController extends AbstractController
{
    #[Breadcrumb('user_profile')]
    public function __invoke(
        #[CurrentUser] User $user
    ): Response {
        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
