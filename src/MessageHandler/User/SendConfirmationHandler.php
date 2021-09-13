<?php

namespace App\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\ConfirmUser;
use App\Message\User\SendConfirmation;
use App\Repository\User\UserRepository;
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

    public function __invoke(SendConfirmation $message): User
    {
        $user = $message->getUser();

        $user->requestConfirmation();

        $this->userRepository->save();

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

        return $user;
    }
}
