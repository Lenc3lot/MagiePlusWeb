<?php

declare(strict_types=1);

namespace App\Entity;

class User
{
    private ?int $id = null;
    private string $nom;
    private string $prenom;
    private string $login;
    private string $password;
    private array $evenements = [];

    public function __construct(?int $id = null, string $nom = '', string $prenom = '', string $login = '', string $password = '', array $evenements = [])
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->login = $login;
        $this->password = $password;
        $this->evenements = $evenements;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function getEvenements(): array
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!in_array($evenement, $this->evenements, true)) {
            $this->evenements[] = $evenement;
        }
        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        $this->evenements = array_filter($this->evenements, fn($e) => $e !== $evenement);
        return $this;
    }
}
