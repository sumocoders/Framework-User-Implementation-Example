<?php

namespace App\Controller;

use App\Controller\User\ProfileController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function __invoke(): Response
    {
        return $this->redirectToRoute(ProfileController::class);
    }
}
