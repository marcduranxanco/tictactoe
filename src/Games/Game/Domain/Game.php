<?php

namespace App\Games;

use App\Users\User;
use Exception;
use iGame;

class Game implements iGame
{
    private Array $users;
    private string $idGame;
    private User $winner;
    private int $maxUsers;
    private int $minUsers;

    public function __construct(
        Array $p_users,
        int $p_maxUsers,
        int $p_minUsers
    ) {
        $this->idGame   = uniqid();
        $this->maxUsers = $p_maxUsers;
        $this->minUsers = $p_minUsers;
        $this->users    = $p_users;
        if(!$this->userValidation())
            throw new Exception("Error Validating the users", 1);
    }

    public function userValidation(): bool
    {
        $result = true;
        if(count($this->users) > $this->maxUsers || count($this->users) < $this->minUsers)
            $result = false;

        foreach ($this->users as $user) {
            if(get_class($user) !== 'App\Users\User')
                $result = false;
        }

        return $result;
    }

    public function setWinner(User $p_user): string
    {
        $this->winner = $p_user;
        return $this->winner->getName();
    }

    private function saveGame(): void
    {
        $this->idGame;
        $this->users;
        $this->winner;
    }

    private function isFinished(): bool
    {
        return ($this->winner == null);
    }
}
