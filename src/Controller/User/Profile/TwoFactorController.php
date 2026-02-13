<?php

namespace App\Controller\User\Profile;

use App\Entity\User\User;
use App\Form\User\Disable2FaType;
use App\Form\User\Enable2FaType;
use App\Message\User\Disable2Fa;
use App\Message\User\Enable2Fa;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;
use SumoCoders\FrameworkCoreBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/user/2fa', name: 'user_2fa')]
class TwoFactorController extends AbstractController
{
    public function __construct(
        private readonly TotpAuthenticatorInterface $totpAuthenticator,
        private readonly MessageBusInterface $messageBus,
        private readonly TranslatorInterface $translator,
    ) {
    }

    #[Breadcrumb('user_2fa')]
    public function __invoke(
        #[CurrentUser] User $user,
        SessionInterface $session,
        Request $request,
    ): Response {
        $is2FaEnabled = $user->isTotpAuthenticationEnabled();
        $showBackupCodes = false;

        if (!$is2FaEnabled) {
            if (!$session->has('2fa_secret')) {
                $secret = $this->totpAuthenticator->generateSecret();
                $session->set('2fa_secret', $secret);
            }
            $secret = $session->get('2fa_secret');

            $message = new Enable2Fa($user, $secret);
            $enable2FaForm = $this->createForm(Enable2FaType::class, $message);
            $enable2FaForm->handleRequest($request);

            if ($enable2FaForm->isSubmitted() && $enable2FaForm->isValid()) {
                $this->messageBus->dispatch($message);

                $session->remove('2fa_secret');
                $session->set('2fa_show_backup_codes', true);
                $this->addFlash(
                    'success',
                    $this->translator->trans('2FA enabled')
                );

                return $this->redirectToRoute('user_2fa');
            }
        }
        if ($is2FaEnabled) {
            $disable2FaMessage = new Disable2Fa($user);
            $disable2FaForm = $this->createForm(Disable2FaType::class, $disable2FaMessage);
            $disable2FaForm->handleRequest($request);

            if ($disable2FaForm->isSubmitted() && $disable2FaForm->isValid()) {
                $this->messageBus->dispatch($disable2FaMessage);

                $this->addFlash(
                    'success',
                    $this->translator->trans('2FA disabled')
                );

                return $this->redirectToRoute('user_2fa');
            }
        }

        if ($session->has('2fa_show_backup_codes')) {
            $showBackupCodes = $session->get('2fa_show_backup_codes');
            $session->remove('2fa_show_backup_codes');
        }

        return $this->render('user/profile/two_factor.html.twig', [
            'user' => $user,
            'is2FaEnabled' => $is2FaEnabled,
            'showBackupCodes' => $showBackupCodes,
            'enable2FaForm' => $enable2FaForm ?? null,
            'disable2FaForm' => $disable2FaForm ?? null,
        ]);
    }
}
