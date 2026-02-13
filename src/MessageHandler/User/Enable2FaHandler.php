<?php

namespace App\MessageHandler\User;

use App\Message\User\Enable2Fa;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class Enable2FaHandler
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function __invoke(Enable2Fa $message): void
    {
        // generate unique codes
        $codes = [];
        while (count($codes) < 6) {
            $code = str_pad((string) random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            if (!in_array($code, $codes, true)) {
                $codes[] = $code;
            }
        }
        foreach ($codes as $code) {
            $message->user->addBackupCode($code);
        }
        $message->user->setTotpSecret($message->secret);
        $this->userRepository->save();
    }
}
