<?php

namespace App\Games;

use App\Users\User;
use Exception;
use GameRepository;
use iGame;

class Game implements iGame
{
    private Array $users;
    private string $idGame;
    private string $idWinner;
    private int $maxUsers;
    private int $minUsers;
    private GameRepository $gameRepository;

    public function __construct(
        Array $p_users,
        int $p_maxUsers,
        int $p_minUsers,
        GameRepository $p_gameRepository
    ) {
        $this->idGame           = uniqid();
        $this->maxUsers         = $p_maxUsers;
        $this->minUsers         = $p_minUsers;
        $this->users            = $p_users;
        $this->gameRepository   = $p_gameRepository;

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
        $this->idWinner = $p_user->getId();
        return $this->idWinner;
    }

    public function saveGame(): bool
    {
        try {
            $this->gameRepository->saveGame(
                $this->idGame,
                $this->users,
                $this->idWinner,
                $this->isFinished()
            );
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    private function isFinished(): bool
    {
        return ($this->winner == null);
    }
}
