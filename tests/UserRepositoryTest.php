<?php

namespace App\Tests;

use App\DataTransferObject\User\FilterDataTransferObject;
use App\Entity\User\User;
use App\Repository\User\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use SumoCoders\FrameworkCoreBundle\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

class UserRepositoryTest extends KernelTestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->initDatabase($kernel);

        $this->userRepository = $kernel->getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(User::class);
    }

    public function testAddNewUser()
    {
        $newUser = new User('sumo@test.be', ['ROLE_ADMIN']);

        $this->userRepository->add($newUser);

        $user = $this->userRepository->findOneBy(['email' => 'sumo@test.be']);

        $this->assertSame('sumo@test.be', $user->getEmail());
    }

    public function testUpgradePassword()
    {
        $newUser = new User('sumo@test.be', ['ROLE_ADMIN']);

        $this->userRepository->upgradePassword($newUser, 'foobar');

        $this->assertSame($newUser->getPassword(), 'foobar');
    }

    public function testUserFilter()
    {
        $newUser = new User('sumo@test.be', ['ROLE_ADMIN']);

        $this->userRepository->add($newUser);

        $userFilter = new FilterDataTransferObject();
        $userFilter->term = 'sumo@test.be';

        $paginator = $this->userRepository->getAllFilteredUsers($userFilter);

        $this->assertInstanceOf(Paginator::class, $paginator);

        $paginator->paginate();

        $this->assertEquals(1, $paginator->count());
    }

    public function testConfirmationTokenCheck()
    {
        $newUser = new User('sumo@test.be', ['ROLE_ADMIN']);

        $this->userRepository->add($newUser);

        $newUser->requestConfirmation();

        $this->userRepository->save();

        $user = $this->userRepository->checkConfirmationToken($newUser->getConfirmationToken());

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('sumo@test.be', $user->getEmail());
    }

    public function testResetTokenCheck()
    {
        $newUser = new User('sumo@test.be', ['ROLE_ADMIN']);

        $this->userRepository->add($newUser);

        $newUser->requestPassword();

        $this->userRepository->save();

        $user = $this->userRepository->checkResetToken($newUser->getPasswordResetToken());

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('sumo@test.be', $user->getEmail());
    }

    private function initDatabase(KernelInterface $kernel): void
    {
        /** @var EntityManager $entityManager */
        $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager');
        $metaData = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->updateSchema($metaData);
    }
}
