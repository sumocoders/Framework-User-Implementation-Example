<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\User\User;
use App\Message\User\CreateUser;
use App\Message\User\SendConfirmation;
use App\MessageHandler\User\CreateUserHandler;
use App\MessageHandler\User\SendConfirmationHandler;
use App\Repository\User\UserRepository;
use App\ValueObject\User\Role;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserTest extends TestCase
{
    public function testAdminCreateUser()
    {
        $newUserMessage = new CreateUser();
        $newUserMessage->email = 'john.doe@foo.bar';
        $newUserMessage->roles = [];

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->expects($this->once())->method('add');

        $bus = new MessageBus();

        $handler = new CreateUserHandler($userRepository, $bus);

        $newUser = $handler($newUserMessage);

        $this->assertInstanceOf(User::class, $newUser);
        $this->assertNotNull($newUser->getPasswordRequestedAt());
        $this->assertNotNull($newUser->getPasswordResetToken());
        $this->assertFalse($newUser->isEnabled());
    }

    public function testSendConfirmation()
    {
        $userMock = new User('john.doe@foo.bar', []);

        $sendConfirmationMessage = new SendConfirmation($userMock);

        $mailerMock = $this->createMock(MailerInterface::class);
        $mailerMock->expects($this->once())->method('send');

        $routerMock = $this->createMock(RouterInterface::class);
        $routerMock->expects($this->once())->method('generate');

        $translatorMock = $this->createMock(TranslatorInterface::class);
        $translatorMock->expects($this->once())
            ->method('trans')
            ->willReturn('Foo');

        $userRepositoryMock = $this->createMock(UserRepository::class);
        $userRepositoryMock->expects($this->once())->method('save');

        $handler = new SendConfirmationHandler(
            $mailerMock,
            $translatorMock,
            $routerMock,
            $userRepositoryMock,
            'foo@bar.be'
        );

        $newUser = $handler($sendConfirmationMessage);

        $this->assertInstanceOf(User::class, $newUser);
        $this->assertNotNull($newUser->getConfirmationToken());
        $this->assertNotNull($newUser->getConfirmationRequestedAt());
        $this->assertFalse($newUser->isEnabled());
    }

    public function testConfirmUser()
    {
        $userMock = new User('john.doe@foo.bar', []);

        $userMock->requestConfirmation();

        $this->assertNotNull($userMock->getConfirmationRequestedAt());
        $this->assertNotNull($userMock->getConfirmationToken());

        $userMock->confirm();

        $this->assertNull($userMock->getConfirmationRequestedAt());
        $this->assertNull($userMock->getConfirmationToken());
        $this->assertNotNull($userMock->getConfirmedAt());
        $this->assertTrue($userMock->isEnabled());
    }

    public function testSetNewPassword()
    {
        $userMock = new User('john.doe@foo.bar', []);

        $userMock->requestPassword();

        $this->assertNotNull($userMock->getPasswordRequestedAt());
        $this->assertNotNull($userMock->getPasswordResetToken());

        $userMock->setPassword('test123');

        $this->assertNull($userMock->getPasswordRequestedAt());
        $this->assertNull($userMock->getPasswordResetToken());
    }

    public function testEachUserHasAtLeastOneRole()
    {
        $userMock = new User('john.doe@foo.bar', []);

        $this->assertContains(Role::user(), $userMock->getRoles());
    }

    public function testRolesAreCleanForDisplay()
    {
        $userMock = new User('john.doe@foo.bar', []);

        foreach ($userMock->getDisplayRoles() as $role) {
            $this->assertStringNotContainsString('ROLE_', $role);
        }
    }

    public function testUserConfirmation()
    {
        $userMock = new User('john.doe@foo.bar', []);

        $userMock->requestConfirmation();

        $this->assertNotNull($userMock->getConfirmationRequestedAt());
        $this->assertNotNull($userMock->getConfirmationToken());
    }

    public function testUserRequestPassword()
    {
        $userMock = new User('john.doe@foo.bar', []);

        $userMock->requestPassword();

        $this->assertNotNull($userMock->getPasswordRequestedAt());
        $this->assertNotNull($userMock->getPasswordResetToken());
    }
}
