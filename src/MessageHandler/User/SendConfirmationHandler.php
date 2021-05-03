<?php

namespace App\MessageHandler\User;

use App\Message\User\ConfirmUser;
use App\Message\User\SendConfirmation;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

class SendConfirmationHandler implements MessageHandlerInterface
{
    private MailerInterface $mailer;
    private TranslatorInterface $translator;
    private Environment $twig;
    private RouterInterface $router;
    private Address $from;

    public function __construct(
        MailerInterface $mailer,
        TranslatorInterface $translator,
        Environment $twig,
        RouterInterface $router,
        string $fromName,
        string $fromMail
    ) {
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->twig = $twig;
        $this->router = $router;
        $this->from = new Address($fromMail, $fromName);
    }

    public function __invoke(SendConfirmation $message): void
    {
        $user = $message->getUser();
        $email = (new TemplatedEmail())
            ->from($this->from)
            ->to(new Address($user->getEmail(), $user->getEmail()))
            ->subject($this->translator->trans('account.mail.confirm.title'))
            ->htmlTemplate('user/mails/confirm.html.twig')
            ->context([
                'confirmationLink' => $this->router->generate(
                    'confirm',
                    [
                        'token' => $user->getConfirmationToken(),
                    ],
                    RouterInterface::ABSOLUTE_URL
                ),

            ]);

        $this->mailer->send($email);
    }
}
