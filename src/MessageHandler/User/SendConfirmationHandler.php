<?php

namespace App\MessageHandler\User;

use App\Controller\User\ConfirmController;
use App\Entity\User\User;
use App\Message\User\SendConfirmation;
use App\Repository\User\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsMessageHandler]
class SendConfirmationHandler
{
    private readonly Address $from;

    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly TranslatorInterface $translator,
        private readonly RouterInterface $router,
        private readonly UserRepository $userRepository,
        #[Autowire('%mailer.default_sender_name% <%mailer.default_sender_email%>')]
        string $from
    ) {
        $this->from = Address::create($from);
    }

    public function __invoke(SendConfirmation $message): User
    {
        $user = $message->user;
        $user->requestConfirmation();
        $this->userRepository->save();

        $email = (new TemplatedEmail())
            ->from($this->from)
            ->to(new Address($user->getEmail(), $user->getEmail()))
            ->subject($this->translator->trans('account.mail.confirm.title'))
            ->htmlTemplate('user/mails/confirm.html.twig')
            ->context([
                'confirmationLink' => $this->router->generate(
                    'user_confirm',
                    [
                        'token' => $user->getConfirmationToken(),
                    ],
                    RouterInterface::ABSOLUTE_URL
                ),

            ]);

        $this->mailer->send($email);

        return $user;
    }
}
