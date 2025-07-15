<?php

namespace App\Security;

use App\Controller\User\LoginController;
use App\Controller\User\ProfileController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class CustomAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    final public const LOGIN_ROUTE = 'login';

    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator
    ) {
    }

    public function authenticate(Request $request): Passport
    {
        $formData = $request->request->all('login');

        $credentials = [
            'email' => (string) ($formData['email'] ?? ''),
            'password' => (string) ($formData['password'] ?? ''),
            'token' => (string) ($formData['_token'] ?? ''),
        ];

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $credentials['email']);

        return new Passport(
            new UserBadge($credentials['email']),
            new PasswordCredentials($credentials['password']),
            [
                new CsrfTokenBadge('authenticate', $credentials['token']),
                new RememberMeBadge(),
            ],
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('user_profile'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
