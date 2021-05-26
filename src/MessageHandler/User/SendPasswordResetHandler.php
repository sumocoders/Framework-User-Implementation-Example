<?php

namespace App\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\SendPasswordReset;
use App\Repository\User\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SendPasswordResetHandler implements MessageHandlerInterface
{
    private MailerInterface $mailer;
    private TranslatorInterface $translator;
    private RouterInterface $router;
    private Address $from;
    private UserRepository $userRepository;

    public function __construct(
        MailerInterface $mailer,
        TranslatorInterface $translator,
        RouterInterface $router,
        UserRepository $userRepository,
        string $from
    ) {
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->router = $router;
        $this->userRepository = $userRepository;
        $this->from = Address::create($from);
    }

    public function __invoke(SendPasswordReset $message): void
    {
        $user = $this->userRepository->findOneBy([
            'email' => $message->email,
        ]);

        if ($user instanceof User) {
            $user->requestPassword();

            $this->userRepository->save();

            $email = (new TemplatedEmail())
                ->from($this->from)
                ->to(new Address($user->getEmail(), $user->getEmail()))
                ->subject($this->translator->trans('account.mail.reset.title'))
                ->htmlTemplate('user/mails/reset.html.twig')
                ->context([
                    'resetLink' => $this->router->generate(
                        'reset_password',
                        [
                            'token' => $user->getPasswordResetToken(),
                        ],
                        RouterInterface::ABSOLUTE_URL
                    ),

                ]);

            $this->mailer->send($email);
        }
    }
}
