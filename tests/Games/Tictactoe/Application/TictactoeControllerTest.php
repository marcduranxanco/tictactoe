<?php

use App\Games\Tictactoe;
use PHPUnit\Framework\TestCase;
use App\Games\TictactoeController;
use App\Users\User;

class TictactoeControllerTest extends TestCase
{
    public TictactoeController $tictactoe;
    public User $userX;
    public User $userO;

    protected function startGame(): void {
        $this->userX = new User("1", "User1");
        $this->userO = new User("2", "User2");
        $users = [$this->userX, $this->userO];

        $this->tictactoe = new TictactoeController(
            $users

        );
    }

    public function testStart(){
        $this->setUp();
    }

}