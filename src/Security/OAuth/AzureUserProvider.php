<?php

declare(strict_types=1);

namespace App\Security\OAuth;

use App\Entity\User\User;
use App\Event\User\AzureLoginEvent;
use App\Repository\User\UserRepository;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class AzureUserProvider implements UserProviderInterface, OAuthAwareUserProviderInterface
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly string $allowedEmailDomain,
    ) {
    }

    public function loadUserByOAuthUserResponse(UserResponseInterface $response): UserInterface
    {
        $data = $response->getData();
        $oid = $data['oid'] ?? null;
        $email = $response->getEmail();
        $roles = is_array($data['roles'] ?? null) ? $data['roles'] : [];

        if ($oid === null || $email === null) {
            throw new AuthenticationException('Azure response is missing required oid or email claim.');
        }

        // 1. Match on azure_object_id — most common path after first login
        $user = $this->userRepository->findOneBy(['azureObjectId' => $oid]);
        if ($user !== null) {
            $user->syncAzureRoles($roles);

            // Keep email in sync in case it changed in Azure
            if ($user->getEmail() !== $email) {
                $user->update($email, $user->getRoles());
            }

            $this->userRepository->save();
            $this->eventDispatcher->dispatch(new AzureLoginEvent($user));

            return $user;
        }

        // 2. Match on email — existing local user logging in via Azure for the first time
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if ($user !== null) {
            $user->linkAzureAccount($oid);
            $user->syncAzureRoles($roles);
            $this->userRepository->save();
            $this->eventDispatcher->dispatch(new AzureLoginEvent($user));

            return $user;
        }

        // 3. No match — auto-provision if domain whitelist allows it
        $this->assertEmailDomainIsAllowed($email);

        $user = User::createFromAzureProfile($email, $oid, $roles);
        $this->userRepository->add($user);
        $this->eventDispatcher->dispatch(new AzureLoginEvent($user));

        return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Expected instance of %s, got "%s".', User::class, $user::class)
            );
        }

        $refreshedUser = $this->userRepository->find($user->getId());
        if ($refreshedUser === null) {
            throw new UserNotFoundException(sprintf('User with id "%d" not found.', $user->getId()));
        }

        return $refreshedUser;
    }

    public function supportsClass(string $class): bool
    {
        return $class === User::class || is_subclass_of($class, User::class);
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findOneBy(['email' => $identifier]);
        if ($user === null) {
            throw new UserNotFoundException(sprintf('User "%s" not found.', $identifier));
        }

        return $user;
    }

    private function assertEmailDomainIsAllowed(string $email): void
    {
        if ($this->allowedEmailDomain === '') {
            return;
        }

        $allowedDomain = ltrim($this->allowedEmailDomain, '@');
        if (!str_ends_with(strtolower($email), '@' . strtolower($allowedDomain))) {
            throw new AccessDeniedException(
                sprintf('Email domain of "%s" is not allowed to log in via Azure.', $email)
            );
        }
    }
}
