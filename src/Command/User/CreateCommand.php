<?php

declare(strict_types=1);

namespace App\Command\User;

use App\Message\User\CreateUser;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $message = new CreateUser();
        $message->email = $input->getArgument('email');
        $message->roles = $input->getArgument('roles');

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

    protected function configure(): void
    {
        $this->addArgument(
            'email',
            InputArgument::REQUIRED,
            'The email of the user'
        );
        $this->addArgument(
            'roles',
            InputArgument::OPTIONAL | InputArgument::IS_ARRAY,
            'The roles of the user',
            ['ROLE_USER']
        );
    }
}
