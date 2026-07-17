<?php

namespace App\Tests\Repository\User;

use App\DataTransferObject\User\FilterDataTransferObject;
use App\Entity\User\User;
use App\Repository\User\UserRepository;
use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[AllowMockObjectsWithoutExpectations]
class UserRepositoryTest extends KernelTestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        self::bootKernel();
        // @mago-expect analysis:mixed-property-type-coercion,mixed-method-access
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

        static::assertInstanceOf(User::class, $user);
        static::assertSame('user@example.com', $user->getEmail());
        static::assertContains('ROLE_ADMIN', $user->getRoles());
    }

    public function testUpgradePasswordWithUserInstance(): void
    {
        $newUser = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->upgradePassword($newUser, 'super-secret-password');
        static::assertSame($newUser->getPassword(), 'super-secret-password');
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
        $confirmationToken = $newUser->getConfirmationToken();
        if ($confirmationToken === null) {
            throw new \RuntimeException('No confirmation token generated for the user.');
        }
        $user = $this->userRepository->checkConfirmationToken($confirmationToken);

        static::assertInstanceOf(User::class, $user);
        static::assertSame('user@example.com', $user->getEmail());
    }

    public function testCheckConfirmationTokenWithInvalidToken(): void
    {
        $user = $this->userRepository->checkConfirmationToken('non-existing-token');

        static::assertNull($user);
    }

    public function testCheckResetTokenWithValidToken(): void
    {
        $newUser = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($newUser);
        $newUser->requestPassword();
        $this->userRepository->save();
        $passwordResetToken = $newUser->getPasswordResetToken();
        if ($passwordResetToken === null) {
            throw new \RuntimeException('No password reset token generated for the user.');
        }
        $user = $this->userRepository->checkResetToken($passwordResetToken);

        static::assertInstanceOf(User::class, $user);
        static::assertSame('user@example.com', $user->getEmail());
        static::assertEqualsWithDelta($user->getPasswordRequestedAt(), new \DateTimeImmutable(), 1);
    }

    public function testCheckResetTokenWithInvalidToken(): void
    {
        $user = $this->userRepository->checkResetToken('non-existing-token');

        static::assertNull($user);
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
        $results = iterator_to_array($paginator->getResults());

        static::assertSame(1, $paginator->count());
        static::assertInstanceOf(User::class, $results[0]);
        static::assertSame('user@example.com', $results[0]->getEmail());
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
        $results = iterator_to_array($paginator->getResults());

        static::assertSame(2, $paginator->count());
        static::assertInstanceOf(User::class, $results[0]);
        static::assertSame('user@example.com', $results[0]->getEmail());
        static::assertInstanceOf(User::class, $results[1]);
        static::assertSame('other-user@example.com', $results[1]->getEmail());
    }
}
