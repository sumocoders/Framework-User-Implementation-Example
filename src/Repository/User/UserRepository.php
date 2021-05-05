<?php

namespace App\Repository\User;

use App\Entity\User\User;
use DateInterval;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
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
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->add($user);
    }

    public function checkConfirmationToken(string $confirmationToken): ?User
    {
        $now = new DateTime();
        $validDuration = new DateInterval('PT2D'); // 48 hours
        $now->sub($validDuration);

        try {
            return $this->createQueryBuilder('u')
                ->where('u.confirmationToken = :token AND u.confirmedAt >= :now')
                ->setParameter('token', $confirmationToken)
                ->setParameter('now', $now)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            return null;
        }
    }

    public function checkResetToken(string $resetToken): ?User
    {
        $now = new DateTime();
        $validDuration = new DateInterval('PT4H'); // 4 hours
        $now->sub($validDuration);

        try {
            return $this->createQueryBuilder('u')
                ->where('u.passwordResetToken = :token AND u.passwordRequestedAt >= :now')
                ->setParameter('token', $resetToken)
                ->setParameter('now', $now)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            return null;
        }
    }
}
