<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\SendPasswordReset;
use App\MessageHandler\User\SendPasswordResetHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SendPasswordResetHandlerTest extends KernelTestCase
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

    private function sendPasswordReset(): void
    {
        $user = new User('user@example.com', ['ROLE_USER']);
        $this->userRepository->add($user);

        $message = new SendPasswordReset();
        $message->email = 'user@example.com';
        $handler = new SendPasswordResetHandler(
            $this->mailer,
            $this->translator,
            $this->router,
            $this->userRepository,
            'noreply@example.com'
        );
        $handler->__invoke($message);
    }

    public function testUserPasswordResetTokenIsGenerated(): void
    {
        $this->sendPasswordReset();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertIsString($user->getPasswordResetToken());
        $this->assertEqualsWithDelta($user->getPasswordRequestedAt(), new \DateTimeImmutable(), 1);
    }

    public function testEmailIsSent(): void
    {
        $this->sendPasswordReset();

        $this->assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        $this->assertEmailHeaderSame(
            $email,
            'To',
            '"user@example.com" <user@example.com>'
        );
    }

    public function testEmailContainsResetToken(): void
    {
        $this->sendPasswordReset();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        $this->assertEmailTextBodyContains($email, $user->getPasswordResetToken());
        $this->assertEmailHtmlBodyContains($email, $user->getPasswordResetToken());
    }
}
