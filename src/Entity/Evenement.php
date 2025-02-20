<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;

class Evenement
{
    private ?int $id;
    private string $titre;

    private string $img;
    private string $description;
    private DateTime $date;
    private string $lieu;
    private User $createur;
    private array $users = [];

    public function __construct(
        User $createur,
        string $img = '',
        string      $titre = '',
        string      $description = '',
        DateTime   $date = new DateTime(),
        string      $lieu = '',
        ?int        $id = null,
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date = $date;
        $this->lieu = $lieu;
        $this->createur = $createur;
        $this->img = $img;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     * @return $this
     */
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return $this
     */
    public function setDate(DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getLieu(): string
    {
        return $this->lieu;
    }


    /**
     * @param string $lieu
     * @return $this
     */
    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;
        return $this;
    }

    /**
     * @return User
     */
    public function getCreateur(): User
    {
        return $this->createur;
    }

    /**
     * @param User $createur
     * @return $this
     */
    public function setCreateur(User $createur): self
    {
        $this->createur = $createur;
        return $this;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function addUser(User $user): self
    {
        if (!in_array($user, $this->users, true)) {
            $this->users[] = $user;
        }
        return $this;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function removeUser(User $user): self
    {
        $this->users = array_filter($this->users, fn($u) => $u !== $user);
        return $this;
    }

    /**
     * @param array $users
     * @return $this
     */
    public function setUsers(array $users): self
    {
        $this->users = $users;
        return $this;
    }
}
