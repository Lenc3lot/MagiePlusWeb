<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Evenement;
use App\Entity\User;

class EvenementTest extends TestCase
{
    public function testEvenementCreation()
    {
        $user = new User(1, 'testuser', 'password123');
        $date = new \DateTime('2023-12-31');
        $evenement = new Evenement($user, 'img.jpg', 'Event Title', 'Event Description', $date, 'Event Location');

        $this->assertEquals('Event Title', $evenement->getTitre());
        $this->assertEquals('Event Description', $evenement->getDescription());
        $this->assertEquals($date, $evenement->getDate());
        $this->assertEquals('Event Location', $evenement->getLieu());
        $this->assertEquals($user, $evenement->getCreateur());
    }

    public function testAddUser()
    {
        $user = new User(1, 'testuser', 'password123');
        $date = new \DateTime('2023-12-31');
        $evenement = new Evenement($user, 'img.jpg', 'Event Title', 'Event Description', $date, 'Event Location');

        $evenement->addUser($user);
        $this->assertCount(1, $evenement->getUsers());
    }

    public function testRemoveUser()
    {
        $user = new User(1, 'testuser', 'password123');
        $date = new \DateTime('2023-12-31');
        $evenement = new Evenement($user, 'img.jpg', 'Event Title', 'Event Description', $date, 'Event Location');

        $evenement->addUser($user);
        $evenement->removeUser($user);
        $this->assertCount(0, $evenement->getUsers());
    }
}