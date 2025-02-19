<?php

namespace App\Entity;

class User
{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $login = null;
    private ?string $password = null;
    private ?array $evenements = [];
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
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
        $this->evenements = array_filter($this->evenements, function($e) use ($evenement) {
            return $e !== $evenement;
        });
        return $this;
    }
}