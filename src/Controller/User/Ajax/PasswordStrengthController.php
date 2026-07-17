<?php

namespace App\Controller\User\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\PasswordStrengthValidator;

#[Route(
    '/admin/users/ajax/password-strength',
    name: 'admin_user_ajax_password_strength',
    alias: ['user_ajax_password_strength'],
)]
final class PasswordStrengthController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        try {
            // @mago-expect analysis:mixed-assignment
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $password = (string) ($data['password'] ?? '');
        } catch (\JsonException) {
            $password = '';
        }

        return $this->json([
            'strength' => PasswordStrengthValidator::estimateStrength($password),
        ]);
    }
}
