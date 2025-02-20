<?php

namespace App\Entity;

class User
{
    private ?int $id;
    private string $login;
    private string $password;
    private array $events = [];

    public function __construct(
        ?int $id = null,
        string $login = '',
        string $password = '',
        array $events = []
    ) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->events = $events;
    }

    public function getId(): ?int
    {
        return $this->id;
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
        $this->password = $password;
        return $this;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function addEvent(Evenement $event): self
    {
        $this->events[] = $event;
        return $this;
    }

    public function removeEvent(Evenement $event): self
    {
        $key = array_search($event, $this->events, true);
        if ($key !== false) {
            unset($this->events[$key]);
        }
        return $this;
    }


}