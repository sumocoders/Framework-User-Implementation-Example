<?php

declare(strict_types=1);

namespace App\Event\User;

use App\Entity\User\User;
use Symfony\Contracts\EventDispatcher\Event;

final class AzureLoginEvent extends Event
{
    public function __construct(
        private readonly User $user,
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
