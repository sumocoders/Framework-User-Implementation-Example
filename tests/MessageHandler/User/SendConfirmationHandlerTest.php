<?php

namespace App\Tests\MessageHandler\User;

use App\Entity\User\User;
use App\Message\User\SendConfirmation;
use App\MessageHandler\User\SendConfirmationHandler;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\RawMessage;
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
        // @mago-expect analysis:mixed-property-type-coercion,mixed-method-access
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
            'noreply@example.com',
        );
        $handler->__invoke($message);
    }

    public function testUserConfirmationTokenIsGenerated(): void
    {
        $this->sendConfirmation();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        static::assertIsString($user->getConfirmationToken());
        static::assertEqualsWithDelta($user->getConfirmationRequestedAt(), new \DateTimeImmutable(), 1);
    }

    public function testEmailIsSent(): void
    {
        $this->sendConfirmation();

        static::assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        static::assertInstanceOf(RawMessage::class, $email);
        static::assertEmailHeaderSame(
            $email,
            'To',
            '"user@example.com" <user@example.com>',
        );
    }

    public function testEmailContainsConfirmationToken(): void
    {
        $this->sendConfirmation();
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);
        // @mago-expect analysis:mixed-assignment
        $confirmationToken = $user->getConfirmationToken();
        if ($confirmationToken === null) {
            throw new \RuntimeException('Confirmation token is null');
        }

        static::assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        static::assertInstanceOf(RawMessage::class, $email);
        // @mago-expect analysis:mixed-argument
        static::assertEmailTextBodyContains($email, $confirmationToken);
        // @mago-expect analysis:mixed-argument
        static::assertEmailHtmlBodyContains($email, $confirmationToken);
    }
}
