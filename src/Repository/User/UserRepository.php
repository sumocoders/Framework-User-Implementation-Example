<?php

namespace App\Repository\User;

use App\DataTransferObject\User\FilterDataTransferObject;
use App\Entity\User\User;
use DateInterval;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use SumoCoders\FrameworkCoreBundle\Pagination\Paginator;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    private const USERS_PER_PAGE = 9;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function save(): void
    {
        $this->_em->flush();
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->add($user);
    }

    public function checkConfirmationToken(string $confirmationToken): ?User
    {
        $expirationCheck = new DateTime();
        $validDuration = new DateInterval('P2D'); // 48 hours
        $expirationCheck->sub($validDuration);

        try {
            return $this->createQueryBuilder('u')
                ->where('u.confirmationToken = :token AND u.confirmationRequestedAt >= :check')
                ->setParameter('token', $confirmationToken)
                ->setParameter('check', $expirationCheck)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException | NonUniqueResultException $exception) {
            return null;
        }
    }

    public function checkResetToken(string $resetToken): ?User
    {
        $expirationCheck = new DateTime();
        $validDuration = new DateInterval('PT4H'); // 4 hours
        $expirationCheck->sub($validDuration);

        try {
            return $this->createQueryBuilder('u')
                ->where('u.passwordResetToken = :token AND u.passwordRequestedAt >= :check')
                ->setParameter('token', $resetToken)
                ->setParameter('check', $expirationCheck)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException | NonUniqueResultException $exception) {
            return null;
        }
    }

    public function getAllFilteredUsers(FilterDataTransferObject $filter): Paginator
    {
        $queryBuilder = $this->createQueryBuilder('u');

        if (isset($filter->term) && $filter->term !== null) {
            $queryBuilder
                ->where('u.email LIKE :term')
                ->setParameter('term', '%' . $filter->term . '%');
        }

        return new Paginator($queryBuilder);
    }
}
