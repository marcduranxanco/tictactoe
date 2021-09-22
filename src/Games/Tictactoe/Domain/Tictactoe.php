<?php

namespace App\Games;

/*
class tictactoe implements game
(Array Users)
*/

class Game
{
    private Array $users;
    private string $idGame;
    private User $winner;
    private User $winner;

    public function __construct(
        Array $p_users
    ) {
        $this->users = $p_users;
        $this->idGame = uniqid();
    }

    public function userValidation(): bool
    {
        // check all users are users
        return true;
    }

    public function setWinner(User $p_user): void
    {
        $this->winner = $p_user;
    }

    public
}
