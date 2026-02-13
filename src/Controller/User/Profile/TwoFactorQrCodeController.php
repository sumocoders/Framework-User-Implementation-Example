<?php

namespace App\Controller\User\Profile;

use App\Entity\User\User;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\SvgWriter;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/user/2fa/qrcode', name: 'user_2fa_qrcode')]
class TwoFactorQrCodeController extends AbstractController
{
    public function __construct(
        private readonly TotpAuthenticatorInterface $totpAuthenticator,
    ) {
    }

    #[Breadcrumb('user_2fa')]
    public function __invoke(
        #[CurrentUser] User $user,
        SessionInterface $session,
    ): Response {
        if (!$session->has('2fa_secret')) {
            throw new BadRequestException('No secret found in session');
        }

        $clonedUser = clone $user;
        $clonedUser->setTotpSecret($session->get('2fa_secret'));
        $builder = new Builder(
            writer: new SvgWriter(),
            data: $this->totpAuthenticator->getQRContent($clonedUser),
            encoding: new Encoding('UTF-8'),
        );

        return new Response(
            $builder->build()->getString(),
            200,
            [
                'Content-Type' => 'image/svg+xml',
            ]
        );
    }
}
