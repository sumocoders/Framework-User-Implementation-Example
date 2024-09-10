<?php

namespace App\Controller\User\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SumoCoders\FrameworkCoreBundle\Security\PasswordStrengthService;

class PasswordStrengthController extends AbstractController
{
    public function __invoke(
        Request $request,
        PasswordStrengthService $passwordStrengthService
    ): Response {
        $password = json_decode($request->getContent(), true)['password'] ?? '';

        return $this->json([
              'strength' => $passwordStrengthService->estimateStrength($password),
        ]);
    }
}
