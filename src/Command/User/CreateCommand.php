<?php

declare(strict_types=1);

namespace App\Command\User;

use App\Message\User\CreateUser;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(name: 'app:user:create', description: 'Create an user and send activation mail')]
class CreateCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
        private readonly ValidatorInterface $validator,
    ) {
        parent::__construct();
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Argument(description: 'The email of the user')] string $email,
        #[Argument(description: 'The locale to use')] string $locale = 'en',
        #[Argument(description: 'The roles of the user')] array $roles = ['ROLE_USER'],
    ): int {
        $message = new CreateUser();
        $message->email = $email;
        $message->locale = $locale;
        $message->roles = $roles;

        $constraints = $this->validator->validate($message);
        if ($constraints->count() > 0) {
            foreach ($constraints as $constraint) {
                $io->error($constraint->getPropertyPath() . ': ' . $constraint->getMessage());
            }

            return Command::FAILURE;
        }

        $this->messageBus->dispatch($message);

        $io->success('User created, an email has been sent to the user.');

        return Command::SUCCESS;
    }
}
