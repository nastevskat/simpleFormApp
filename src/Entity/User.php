<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    private ?string $fullName = null;
    #[ORM\Column(length: 255)]
    private ?string $email = null;
    #[ORM\Column(length: 255)]
    private ?string $phone = null;
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dob = null;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFullName(): ?string
    {
        return $this->fullName;
    }
    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;
        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(string $phone): static
    {
        $this->phone = $phone;
        return $this;
    }
    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }
    public function setDob(\DateTimeInterface $dob): static
    {
        $this->dob = $dob;
        return $this;
    }
}
