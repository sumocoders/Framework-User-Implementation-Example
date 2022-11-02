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
    private readonly Address $from;

    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly TranslatorInterface $translator,
        private readonly RouterInterface $router,
        private readonly UserRepository $userRepository,
        string $from
    ) {
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
