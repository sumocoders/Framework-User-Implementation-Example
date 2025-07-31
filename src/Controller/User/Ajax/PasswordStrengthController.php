<?php

namespace App\Controller\User\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\DeprecatedAlias;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\PasswordStrengthValidator;

#[Route(
    '/admin/users/ajax/password-strength',
    name: 'admin_user_ajax_password_strength',
    alias: ['user_ajax_password_strength']
)]
class PasswordStrengthController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        $password = json_decode($request->getContent(), true)['password'] ?? '';

        return $this->json([
            'strength' => PasswordStrengthValidator::estimateStrength($password),
        ]);
    }
}
