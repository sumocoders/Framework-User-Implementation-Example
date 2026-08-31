<?php

declare(strict_types=1);

namespace App\Tests\Security\OAuth;

use App\Entity\User\User;
use App\Event\User\AzureLoginEvent;
use App\Repository\User\UserRepository;
use App\Security\OAuth\AzureUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

#[AllowMockObjectsWithoutExpectations]
class AzureUserProviderTest extends KernelTestCase
{
    private UserRepository&MockObject $userRepository;
    private EventDispatcherInterface&MockObject $eventDispatcher;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
    }

    private function makeProvider(): AzureUserProvider
    {
        return new AzureUserProvider($this->userRepository, $this->eventDispatcher);
    }

    /**
     * @param string[] $roles
     */
    private function makeResponse(string $oid, string $email, array $roles = []): UserResponseInterface&MockObject
    {
        $response = $this->createMock(UserResponseInterface::class);
        $response->method('getData')->willReturn(['oid' => $oid, 'roles' => $roles]);
        $response->method('getEmail')->willReturn($email);

        return $response;
    }

    public function testExistingUserFoundByOidIsReturned(): void
    {
        $user = User::createFromAzureProfile('user@sumocoders.be', 'oid-abc');

        $this->userRepository
            ->method('findOneBy')
            ->willReturnMap([
                [['azureObjectId' => 'oid-abc'], $user],
            ]);

        $response = $this->makeResponse('oid-abc', 'user@sumocoders.be');

        $result = $this->makeProvider()->loadUserByOAuthUserResponse($response);

        static::assertSame($user, $result);
    }

    public function testExistingUserFoundByOidHasEmailUpdatedWhenChanged(): void
    {
        $user = User::createFromAzureProfile('old@sumocoders.be', 'oid-abc');

        $this->userRepository
            ->method('findOneBy')
            ->willReturnMap([
                [['azureObjectId' => 'oid-abc'], $user],
            ]);
        $this->userRepository->expects($this->once())->method('save');

        $response = $this->makeResponse('oid-abc', 'new@sumocoders.be');

        $result = $this->makeProvider()->loadUserByOAuthUserResponse($response);

        // @mago-expect analysis:non-existent-method
        static::assertSame('new@sumocoders.be', $result->getEmail());
    }

    public function testExistingLocalUserFoundByEmailGetsOidLinked(): void
    {
        $user = new User('user@sumocoders.be', []);
        $user->confirm();

        $this->userRepository
            ->method('findOneBy')
            ->willReturnMap([
                [['azureObjectId' => 'oid-abc'], null],
                [['email' => 'user@sumocoders.be'], $user],
            ]);
        $this->userRepository->expects($this->once())->method('save');

        $response = $this->makeResponse('oid-abc', 'user@sumocoders.be');

        $result = $this->makeProvider()->loadUserByOAuthUserResponse($response);

        static::assertSame($user, $result);
        static::assertSame('oid-abc', $result->getAzureObjectId());
    }

    public function testNewUserIsAutoProvisionedWhenDomainMatches(): void
    {
        $this->userRepository
            ->method('findOneBy')
            ->willReturn(null);
        $this->userRepository->expects($this->once())->method('add');

        $response = $this->makeResponse('oid-new', 'newuser@sumocoders.be');

        $result = $this->makeProvider()->loadUserByOAuthUserResponse($response);

        // @mago-expect analysis:non-existent-method
        static::assertSame('newuser@sumocoders.be', $result->getEmail());
        // @mago-expect analysis:non-existent-method
        static::assertSame('oid-new', $result->getAzureObjectId());
        // @mago-expect analysis:non-existent-method
        static::assertTrue($result->isEnabled());
        // @mago-expect analysis:non-existent-method
        static::assertTrue($result->isConfirmed());
    }

    public function testNewUserIsAutoProvisionedWhenNoDomainRestriction(): void
    {
        $this->userRepository
            ->method('findOneBy')
            ->willReturn(null);
        $this->userRepository->expects($this->once())->method('add');

        $response = $this->makeResponse('oid-new', 'anyone@otherdomain.com');

        $result = $this->makeProvider()->loadUserByOAuthUserResponse($response);

        // @mago-expect analysis:non-existent-method
        static::assertSame('anyone@otherdomain.com', $result->getEmail());
    }

    public function testNewUserWithWrongDomainIsRejected(): void
    {
        $this->userRepository
            ->method('findOneBy')
            ->willReturn(null);

        $response = $this->makeResponse('oid-new', 'attacker@evil.com');

        $this->expectException(AccessDeniedException::class);

        $this->makeProvider()->loadUserByOAuthUserResponse($response);
    }

    public function testDomainCheckIsCaseInsensitive(): void
    {
        $this->userRepository
            ->method('findOneBy')
            ->willReturn(null);
        $this->userRepository->expects($this->once())->method('add');

        $response = $this->makeResponse('oid-new', 'user@SUMOCODERS.BE');

        $result = $this->makeProvider()->loadUserByOAuthUserResponse($response);

        // @mago-expect analysis:non-existent-method
        static::assertSame('user@SUMOCODERS.BE', $result->getEmail());
    }

    public function testAzureRolesAreSyncedOnEveryLoginByOid(): void
    {
        $user = User::createFromAzureProfile('user@sumocoders.be', 'oid-abc');

        $this->userRepository
            ->method('findOneBy')
            ->willReturnMap([
                [['azureObjectId' => 'oid-abc'], $user],
            ]);

        $response = $this->makeResponse('oid-abc', 'user@sumocoders.be', ['ROLE_ADMIN']);

        $result = $this->makeProvider()->loadUserByOAuthUserResponse($response);

        static::assertContains('ROLE_ADMIN', $result->getRoles());
        static::assertContains('ROLE_USER', $result->getRoles());
    }

    public function testAzureRolesAreSyncedWhenLocalUserLinksAccount(): void
    {
        $user = new User('user@sumocoders.be', []);
        $user->confirm();

        $this->userRepository
            ->method('findOneBy')
            ->willReturnMap([
                [['azureObjectId' => 'oid-abc'], null],
                [['email' => 'user@sumocoders.be'], $user],
            ]);

        $response = $this->makeResponse('oid-abc', 'user@sumocoders.be', ['ROLE_ADMIN']);

        $result = $this->makeProvider()->loadUserByOAuthUserResponse($response);

        static::assertContains('ROLE_ADMIN', $result->getRoles());
    }

    public function testAzureRolesAreSyncedForNewUser(): void
    {
        $this->userRepository
            ->method('findOneBy')
            ->willReturn(null);
        $this->userRepository->expects($this->once())->method('add');

        $response = $this->makeResponse('oid-new', 'newuser@sumocoders.be', ['ROLE_ADMIN']);

        $result = $this->makeProvider()->loadUserByOAuthUserResponse($response);

        static::assertContains('ROLE_ADMIN', $result->getRoles());
    }

    public function testLoginEventIsDispatchedOnEverySuccessfulLogin(): void
    {
        $user = User::createFromAzureProfile('user@sumocoders.be', 'oid-abc');

        $this->userRepository
            ->method('findOneBy')
            ->willReturnMap([
                [['azureObjectId' => 'oid-abc'], $user],
            ]);

        $this->eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(static::isInstanceOf(AzureLoginEvent::class));

        $response = $this->makeResponse('oid-abc', 'user@sumocoders.be');
        $this->makeProvider()->loadUserByOAuthUserResponse($response);
    }

    public function testEmptyAzureRolesResultInOnlyRoleUser(): void
    {
        $user = User::createFromAzureProfile('user@sumocoders.be', 'oid-abc', ['ROLE_ADMIN']);

        $this->userRepository
            ->method('findOneBy')
            ->willReturnMap([
                [['azureObjectId' => 'oid-abc'], $user],
            ]);

        // Azure sends no roles this time (e.g. role was revoked)
        $response = $this->makeResponse('oid-abc', 'user@sumocoders.be', []);

        $result = $this->makeProvider()->loadUserByOAuthUserResponse($response);

        static::assertNotContains('ROLE_ADMIN', $result->getRoles());
        static::assertContains('ROLE_USER', $result->getRoles());
    }
}
