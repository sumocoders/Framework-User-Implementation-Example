<?php

namespace App\Entity\User;

use App\Repository\User\UserRepository;
use App\ValueObject\User\Role;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Scheb\TwoFactorBundle\Model\BackupCodeInterface;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfiguration;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfigurationInterface;
use Scheb\TwoFactorBundle\Model\Totp\TwoFactorInterface;
use SumoCoders\FrameworkCoreBundle\Attribute\AuditTrail\AuditTrail;
use SumoCoders\FrameworkCoreBundle\Attribute\AuditTrail\SensitiveData;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
#[UniqueEntity('email', message: "There is already an account with this email")]
#[AuditTrail]
class User implements UserInterface, PasswordAuthenticatedUserInterface, TwoFactorInterface, BackupCodeInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', nullable: true)]
    #[SensitiveData]
    private ?string $password;

    #[ORM\Column(type: 'boolean')]
    private bool $enabled;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $confirmationToken;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $confirmationRequestedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $confirmedAt;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $passwordResetToken;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $passwordRequestedAt;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $totpSecret = null;

    /** @var array<int, string> $backupCodes */
    #[ORM\Column(type: 'json')]
    private array $backupCodes = [];

    /**
     * @param array<int, string> $roles
     */
    public function __construct(
        #[ORM\Column(type: 'string', length: 180, unique: true)]
        private string $email,
        #[ORM\Column(type: 'json')]
        private array $roles
    ) {
        $this->password = null;
        $this->enabled = false;
        $this->confirmationToken = null;
        $this->confirmationRequestedAt = null;
        $this->confirmedAt = null;
        $this->passwordResetToken = null;
        $this->passwordRequestedAt = null;
    }

    /**
     * @param array<int, string> $roles
     */
    public function update(
        string $email,
        array $roles
    ): void {
        $this->email = $email;
        $this->roles = $roles;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->email; // @phpstan-ignore-line return.type
    }

    public function getOriginUsername(): string
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        // guarantee every user at least has ROLE_USER
        $roles[] = Role::user();

        return array_unique($roles);
    }

    /**
     * @return array<int, string> $roles
     */
    public function getDisplayRoles(): array
    {
        return array_map(fn(string $role) => strtolower(substr($role, 5)), $this->getRoles());
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
        $this->erasePasswordResetRequest();
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function getConfirmationRequestedAt(): ?DateTime
    {
        return $this->confirmationRequestedAt;
    }

    public function getConfirmedAt(): ?DateTime
    {
        return $this->confirmedAt;
    }

    public function requestConfirmation(): void
    {
        $this->confirmationToken = $this->generateToken();
        $this->confirmationRequestedAt = new DateTime();
    }

    public function isConfirmed(): bool
    {
        return null !== $this->confirmedAt;
    }

    public function confirm(): void
    {
        $this->confirmationToken = null;
        $this->confirmationRequestedAt = null;
        $this->confirmedAt = new DateTime();
        $this->enabled = true;
    }

    public function getPasswordResetToken(): ?string
    {
        return $this->passwordResetToken;
    }

    public function getPasswordRequestedAt(): ?DateTime
    {
        return $this->passwordRequestedAt;
    }

    public function requestPassword(): void
    {
        $this->passwordResetToken = $this->generateToken();
        $this->passwordRequestedAt = new DateTime();
    }

    public function erasePasswordResetRequest(): void
    {
        $this->passwordResetToken = null;
        $this->passwordRequestedAt = null;
    }

    public function enable(): void
    {
        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    private function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    public function isTotpAuthenticationEnabled(): bool
    {
        return $this->totpSecret !== null;
    }

    public function setTotpSecret(string $totpSecret): void
    {
        $this->totpSecret = $totpSecret;
    }

    public function clearTotpSecret(): void
    {
        $this->totpSecret = null;
    }

    public function getTotpAuthenticationUsername(): string|null
    {
        return $this->email;
    }

    public function getTotpAuthenticationConfiguration(): ?TotpConfigurationInterface
    {
        return new TotpConfiguration(
            $this->totpSecret,
            TotpConfiguration::ALGORITHM_SHA1,
            30,
            6
        );
    }

    /**
     * @return array<int, string>
     */
    public function getBackupCodes(): array
    {
        return $this->backupCodes;
    }

    public function isBackupCode(string $code): bool
    {
        return in_array($code, $this->backupCodes);
    }

    public function invalidateBackupCode(string $backupCode): void
    {
        $key = array_search($backupCode, $this->backupCodes);
        if ($key !== false) {
            unset($this->backupCodes[$key]);
        }
    }

    public function addBackupCode(string $backupCode): void
    {
        if (!in_array($backupCode, $this->backupCodes)) {
            $this->backupCodes[] = $backupCode;
        }
    }

    public function clearBackupCodes(): void
    {
        $this->backupCodes = [];
    }
}
