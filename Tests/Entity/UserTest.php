<?php

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Evenement;

class UserTest extends TestCase
{
    public function testUserCreation()
    {
        $user = new User(1, 'testuser', 'password123');
        $this->assertEquals(1, $user->getId());
        $this->assertEquals('testuser', $user->getLogin());
        $this->assertEquals('password123', $user->getPassword());
    }

    public function testAddEvent()
    {
        $user = new User(1, 'testuser', 'password123');
        $event = $this->createMock(Evenement::class);
        $user->addEvent($event);
        $this->assertCount(1, $user->getEvents());
    }

    public function testRemoveEvent()
    {
        $user = new User(1, 'testuser', 'password123');
        $event = $this->createMock(Evenement::class);
        $user->addEvent($event);
        $user->removeEvent($event);
        $this->assertCount(0, $user->getEvents());
    }
}