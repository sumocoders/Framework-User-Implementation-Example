<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function __invoke(
        Request $request,
        #[Autowire('%locales%')] array $locales,
    ): Response {
        return $this->redirectToRoute('user_profile', ['_locale' => $request->getPreferredLanguage($locales)]);
    }
}
