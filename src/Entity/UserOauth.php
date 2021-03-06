<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Smart\CoreBundle\Doctrine\ColumnTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table("users_oauths",
 *      indexes={
 *          @ORM\Index(columns={"created_at"}),
 *          @ORM\Index(columns={"email"}),
 *      },
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(columns={"identifier", "provider"}),
 *          @ORM\UniqueConstraint(columns={"email", "provider"}),
 *          @ORM\UniqueConstraint(columns={"access_token"}),
 *      }
 * )
 */
class UserOauth
{
    use ColumnTrait\Id;
    use ColumnTrait\CreatedAt;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="oauths", cascade={"persist"})
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    protected $access_token;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $refresh_token;

    /**
     * @var integer
     *
     * @ORM\Column(type="bigint", nullable=false)
     */
    protected $identifier;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    protected $provider;

    /**
     * UserOauth constructor.
     */
    public function __construct()
    {
        $this->created_at   = new \DateTime();
        $this->provider     = 'vkontakte';
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return $this
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     *
     * @return $this
     */
    public function setAccessToken($access_token): self
    {
        $this->access_token = $access_token;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refresh_token;
    }

    /**
     * @param string|null $refresh_token
     *
     * @return $this
     */
    public function setRefreshToken($refresh_token): self
    {
        $this->refresh_token = $refresh_token;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdentifier(): int
    {
        return (int) $this->identifier;
    }

    /**
     * @param int $identifier
     *
     * @return $this
     */
    public function setIdentifier(int $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     *
     * @return $this
     */
    public function setProvider($provider): self
    {
        $this->provider = $provider;

        return $this;
    }
}
