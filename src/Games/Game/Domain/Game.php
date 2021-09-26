<?php

namespace App\Games;

use App\Users\User;
use Exception;
use GameRepository;
use iGame;
define("GAME_STATUS_OPTIONS", ["unstarted", "playing", "drawn", "finished"]);

class Game implements iGame
{
    protected string $gameStatus;
    protected array $users;
    protected string $idGame;
    protected string $idWinner;
    protected int $maxUsers;
    protected int $minUsers;

    public function __construct(
        array $p_users,
        int $p_maxUsers,
        int $p_minUsers
    ) {
        $this->idGame           = uniqid();
        $this->maxUsers         = $p_maxUsers;
        $this->minUsers         = $p_minUsers;
        $this->users            = $p_users;
        $this->setNewStatus("unstarted");

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
        return $p_user->getId();
    }

    public function setNewStatus(string $newStatus) : void
    {
        if(in_array($newStatus, GAME_STATUS_OPTIONS))
            $this->gameStatus = $newStatus;
        else
            throw new Exception("Error. New game status not valid", 1);
    }

    protected function isFinished(): bool
    {
        return ($this->gameStatus == "finished" || $this->gameStatus == "drawn");
    }
}
