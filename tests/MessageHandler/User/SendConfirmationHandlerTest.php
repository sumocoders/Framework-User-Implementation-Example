<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\SendConfirmation;
use App\Message\User\SendPasswordReset;
use App\MessageHandler\User\SendConfirmationHandler;
use App\MessageHandler\User\SendPasswordResetHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SendConfirmationHandlerTest extends KernelTestCase
{
    private UserRepository $userRepository;
    private MailerInterface $mailer;
    private TranslatorInterface $translator;
    private RouterInterface $router;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->userRepository = static::getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(User::class);
        $this->mailer = static::getContainer()->get('mailer.mailer');
        $this->translator = static::getContainer()->get('translator');
        $this->router = static::getContainer()->get('router');
    }

    private function sendConfirmation(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $this->userRepository->add($user);

        $message = new SendConfirmation($user->getId(), 'nl');
        $handler = new SendConfirmationHandler(
            $this->mailer,
            $this->translator,
            $this->router,
            $this->userRepository,
            'noreply@example.com'
        );
        $handler->__invoke($message);
    }

    public function testUserConfirmationTokenIsGenerated(): void
    {
        $this->sendConfirmation();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertIsString($user->getConfirmationToken());
        $this->assertEqualsWithDelta($user->getConfirmationRequestedAt(), new \DateTimeImmutable(), 1);
    }

    public function testEmailIsSent(): void
    {
        $this->sendConfirmation();

        $this->assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        $this->assertEmailHeaderSame(
            $email,
            'To',
            '"user@example.com" <user@example.com>'
        );
    }

    public function testEmailContainsConfirmationToken(): void
    {
        $this->sendConfirmation();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        $this->assertEmailTextBodyContains($email, $user->getConfirmationToken());
        $this->assertEmailHtmlBodyContains($email, $user->getConfirmationToken());
    }
}
