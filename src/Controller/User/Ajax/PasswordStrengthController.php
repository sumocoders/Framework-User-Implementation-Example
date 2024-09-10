<?php

namespace App\Controller\User\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SumoCoders\FrameworkCoreBundle\Security\PasswordStrengthService;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/users/ajax/password-strength', name: 'admin_user_ajax_password_strength')]
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
