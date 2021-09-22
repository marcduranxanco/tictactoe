<?php

use PHPUnit\Framework\TestCase;
use App\Games\Game;
use App\Users\User;

class GameTest extends TestCase
{
    private Game $game;
    private User $user1;
    private User $user2;

    protected function setUp(): void {
        $this->user1 = new User("11111", "User1");
        $this->user2 = new User("22222", "User2");
        $users = [$this->user1, $this->user2];
        $this->game = New Game($users,3,2);
    }

    public function testSetWinner(){
        $this->setUp();
        self::assertEquals($this->game->setWinner($this->user1), "User1");
    }
}