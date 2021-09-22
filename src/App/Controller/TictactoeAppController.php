<?php

namespace App\Controller;

use App\Games\Game;
use App\Games\Tictactoe;
use App\Games\InMemoryRepository;
use App\Users\User;

class TictactoeAppController
{
    private Tictactoe $game;

    public function __construct()
    {
        $users = [
            new User(1, "User1"),
            new User(2, "User2"),
        ];
        $this->game = new Tictactoe($users, new InMemoryRepository());
    }

    public function run(): string
    {
        return "Round one fight!";
    }
}
