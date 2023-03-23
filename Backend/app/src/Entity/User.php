<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements PasswordAuthenticatedUserInterface {
    #[Groups(['subject', 'department', 'schoolclass','user'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Groups(['subject', 'department', 'schoolclass','user'])]
    #[ORM\Column(length: 255)]
    private ?string $shortName = null;
    
    #[Groups(['subject', 'department', 'schoolclass','user'])]
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;
    
    #[Groups(['subject', 'department', 'schoolclass','user'])]
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;
    
    #[Groups(['subject', 'department', 'schoolclass','user'])]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[Ignore]
    #[ORM\Column(length: 255)]
    private ?string $token = null;
    
    #[Ignore]
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[Groups(['subject', 'department', 'schoolclass','user'])]
    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Role $roleId = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getShortName(): ?string {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self {
        $this->shortName = $shortName;

        return $this;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;

        return $this;
    }

    public function getToken(): ?string {
        return $this->token;
    }

    public function setToken(string $token): self {
        $this->token = $token;

        return $this;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(string $password): self {
        $this->password = $password;

        return $this;
    }

    public function getRoleId(): ?Role {
        return $this->roleId;
    }

    public function setRoleId(?Role $roleId): self {
        $this->roleId = $roleId;

        return $this;
    }
}
