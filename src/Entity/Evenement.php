<?php

declare(strict_types=1);

namespace App\Entity;

class Evenement
{
    private ?int $id;
    private string $titre;
    private string $description;
    private \DateTime $date;
    private string $lieu;
    private User $createur;
    private array $users = [];

    public function __construct(
        User $createur,
        ?int $id = null,
        string $titre = '',
        string $description = '',
        \DateTime $date = new \DateTime(),
        string $lieu = ''
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date = $date;
        $this->lieu = $lieu;
        $this->createur = $createur;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getLieu(): string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getCreateur(): User
    {
        return $this->createur;
    }

    public function setCreateur(User $createur): self
    {
        $this->createur = $createur;
        return $this;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!in_array($user, $this->users, true)) {
            $this->users[] = $user;
        }
        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users = array_filter($this->users, fn($u) => $u !== $user);
        return $this;
    }
}
