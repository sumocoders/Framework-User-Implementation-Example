<?php

namespace App\Tests\Repository\User;

use App\DataTransferObject\User\FilterDataTransferObject;
use App\Entity\User\User;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserRepositoryTest extends KernelTestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->userRepository = static::getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(User::class);
    }

    public function testAddUserWithRoleAdmin(): void
    {
        $newUser = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($newUser);
        $user = $this->userRepository->findOneBy(['email' => 'user@example.com']);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('user@example.com', $user->getEmail());
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
    }

    public function testUpgradePasswordWithUserInstance(): void
    {
        $newUser = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->upgradePassword($newUser, 'super-secret-password');
        $this->assertSame($newUser->getPassword(), 'super-secret-password');
    }

    public function testUpgradePasswordWithInvalidUserInstance(): void
    {
        $newUser = $this->createMock(PasswordAuthenticatedUserInterface::class); // Not a User instance
        $this->expectException(UnsupportedUserException::class);
        $this->userRepository->upgradePassword($newUser, 'super-secret-password');
    }

    public function testCheckConfirmationTokenWithValidToken(): void
    {
        $newUser = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($newUser);
        $newUser->requestConfirmation();
        $this->userRepository->save();
        $user = $this->userRepository->checkConfirmationToken($newUser->getConfirmationToken());

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('user@example.com', $user->getEmail());
    }

    public function testCheckConfirmationTokenWithInvalidToken(): void
    {
        $user = $this->userRepository->checkConfirmationToken('non-existing-token');

        $this->assertNull($user);
    }

    public function testCheckResetTokenWithValidToken(): void
    {
        $newUser = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($newUser);
        $newUser->requestPassword();
        $this->userRepository->save();
        $user = $this->userRepository->checkResetToken($newUser->getPasswordResetToken());

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('user@example.com', $user->getEmail());
        $this->assertEqualsWithDelta($user->getPasswordRequestedAt(), new \DateTimeImmutable(), 1);
    }

    public function testCheckResetTokenWithInvalidToken(): void
    {
        $user = $this->userRepository->checkResetToken('non-existing-token');

        $this->assertNull($user);
    }

    public function testFilterForExistingUser(): void
    {
        $newUser = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($newUser);
        $otherUser = new User('user2@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($otherUser);

        $userFilter = new FilterDataTransferObject();
        $userFilter->term = 'user@example.com';
        $paginator = $this->userRepository->getAllFilteredUsers($userFilter);
        $paginator->paginate();

        $this->assertSame(1, $paginator->count());
        $this->assertInstanceOf(User::class, $paginator->getResults()[0]);
        $this->assertSame('user@example.com', $paginator->getResults()[0]->getEmail());
    }

    public function testFilterWithoutTerm(): void
    {
        $newUser = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($newUser);
        $otherUser = new User('other-user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($otherUser);

        $userFilter = new FilterDataTransferObject();
        $paginator = $this->userRepository->getAllFilteredUsers($userFilter);
        $paginator->paginate();

        $this->assertSame(2, $paginator->count());
        $this->assertInstanceOf(User::class, $paginator->getResults()[0]);
        $this->assertSame('user@example.com', $paginator->getResults()[0]->getEmail());
        $this->assertInstanceOf(User::class, $paginator->getResults()[1]);
        $this->assertSame('other-user@example.com', $paginator->getResults()[1]->getEmail());
    }
}
