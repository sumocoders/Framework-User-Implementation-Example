<?php

declare(strict_types=1);

namespace App\Tests\Validator\User;

use App\Entity\User\User;
use App\Message\User\CreateUser;
use App\Message\User\UpdateUser;
use App\Repository\User\UserRepository;
use App\Validator\User\UniqueEmail;
use App\Validator\User\UniqueEmailValidator;
use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

#[AllowMockObjectsWithoutExpectations]
class UniqueEmailValidatorTest extends KernelTestCase
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

    public function testNoViolationWhenEmailIsUniqueForCreateUser(): void
    {
        $context = $this
            ->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects(self::never())->method('buildViolation');
        $validator = new UniqueEmailValidator($this->userRepository);

        $validator->validateInContext('user@example.com', new UniqueEmail(), $context);
    }

    public function testNoViolationWhenEmailIsBlank(): void
    {
        $context = $this
            ->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects(self::never())->method('buildViolation');
        $validator = new UniqueEmailValidator($this->userRepository);

        $validator->validateInContext('', new UniqueEmail(), $context);
        $validator->validateInContext(null, new UniqueEmail(), $context);
    }

    public function testExceptionWhenEmailIsNumber(): void
    {
        $context = $this
            ->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $validator = new UniqueEmailValidator($this->userRepository);

        $this->expectException(UnexpectedValueException::class);

        $validator->validateInContext(1, new UniqueEmail(), $context);
    }

    public function testViolationWhenEmailIsNotUnique(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($user);
        $createUser = new CreateUser();
        $createUser->email = 'user@example.com';

        $context = $this
            ->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects(self::once())->method('getObject')->willReturn($createUser);
        $context->expects(self::once())->method('buildViolation');
        $validator = new UniqueEmailValidator($this->userRepository);

        $validator->validateInContext('user@example.com', new UniqueEmail(), $context);
    }

    public function testNoViolationWhileEditingTheUser(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($user);
        $updateUser = new UpdateUser($user);

        $context = $this
            ->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects(self::once())->method('getObject')->willReturn($updateUser);
        $context->expects(self::never())->method('buildViolation');
        $validator = new UniqueEmailValidator($this->userRepository);

        $validator->validateInContext('user@example.com', new UniqueEmail(), $context);
    }

    public function testViolationWhileEditingTheUserWithExistingEmail(): void
    {
        $user = new User('user@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($user);
        $existingUser = new User('user-existing@example.com', ['ROLE_ADMIN']);
        $this->userRepository->add($existingUser);
        $updateUser = new UpdateUser($user);

        $context = $this
            ->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects(self::once())->method('getObject')->willReturn($updateUser);
        $context->expects(self::once())->method('buildViolation');
        $validator = new UniqueEmailValidator($this->userRepository);

        $validator->validateInContext('user-existing@example.com', new UniqueEmail(), $context);
    }
}
