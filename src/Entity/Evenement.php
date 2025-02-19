<?php

namespace App\Entity;

class Evenement
{
    private ?int $id = null;
    private ?string $titre = null;
    private ?string $description = null;
    private ?\DateTime $date = null;
    private ?string $lieu = null;
    private ?User $id_utilisateur = null;
    private ?array $users = [];

    public function __construct($params = null) {
        if (!is_null($params)) {
            foreach ($params as $cle => $valeur) {
                $this->$cle = $valeur;
            }
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getId_utilisateur(): ?User
    {
        return $this->id_utilisateur;
    }

    public function setId_utilisateur(User $user): self
    {
        $this->id_utilisateur = $user;
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
        $this->users = array_filter($this->users, function($u) use ($user) {
            return $u !== $user;
        });
        return $this;
    }
}