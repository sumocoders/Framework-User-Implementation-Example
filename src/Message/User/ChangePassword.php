<?php

namespace App\Message\User;

use App\Entity\User\User;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{
  private User $user;

  /**
   * @Assert\NotBlank()
   */
  public string $password;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function getUser(): User
  {
    return $this->user;
  }
}
