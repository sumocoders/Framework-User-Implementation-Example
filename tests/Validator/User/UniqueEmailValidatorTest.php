<?php

declare(strict_types=1);

namespace App\Tests\Validator\User;

use App\Entity\User\User;
use App\Message\User\CreateUser;
use App\Message\User\UpdateUser;
use App\Repository\User\UserRepository;
use App\Validator\User\UniqueEmail;
use App\Validator\User\UniqueEmailValidator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

#[AllowMockObjectsWithoutExpectations]
class UniqueEmailValidatorTest extends KernelTestCase
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

    public function testNoViolationWhenEmailIsUniqueForCreateUser(): void
    {
        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects(self::never())->method('buildViolation');
        $validator = new UniqueEmailValidator($this->userRepository);
        $validator->initialize($context);

        $validator->validate('user@example.com', new UniqueEmail());
    }

    public function testNoViolationWhenEmailIsBlank(): void
    {
        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects(self::never())->method('buildViolation');
        $validator = new UniqueEmailValidator($this->userRepository);
        $validator->initialize($context);

        $validator->validate('', new UniqueEmail());
        $validator->validate(null, new UniqueEmail());
    }

    public function testExceptionWhenEmailIsNumber(): void
    {
        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $validator = new UniqueEmailValidator($this->userRepository);
        $validator->initialize($context);

        $this->expectException(UnexpectedValueException::class);

        $validator->validate(1, new UniqueEmail());
    }

    public function testViolationWhenEmailIsNotUnique(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($user);
        $createUser = new CreateUser();
        $createUser->email = 'user@example.com';

        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects(self::once())->method('getObject')
            ->willReturn($createUser);
        $context->expects(self::once())->method('buildViolation');
        $validator = new UniqueEmailValidator($this->userRepository);
        $validator->initialize($context);

        $validator->validate('user@example.com', new UniqueEmail());
    }

    public function testNoViolationWhileEditingTheUser(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($user);
        $updateUser = new UpdateUser($user);

        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects(self::once())->method('getObject')
            ->willReturn($updateUser);
        $context->expects(self::never())->method('buildViolation');
        $validator = new UniqueEmailValidator($this->userRepository);
        $validator->initialize($context);

        $validator->validate('user@example.com', new UniqueEmail());
    }

    public function testViolationWhileEditingTheUserWithExistingEmail(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($user);
        $existingUser = new User('user-existing@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($existingUser);
        $updateUser = new UpdateUser($user);

        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects(self::once())->method('getObject')
            ->willReturn($updateUser);
        $context->expects(self::once())->method('buildViolation');
        $validator = new UniqueEmailValidator($this->userRepository);
        $validator->initialize($context);

        $validator->validate('user-existing@example.com', new UniqueEmail());
    }
}
