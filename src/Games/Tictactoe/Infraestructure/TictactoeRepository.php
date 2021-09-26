<?php

namespace App\Games;

use GameRepository;

class TictactoeRepository implements GameRepository {

    private string $idGame;
    private array $users;
    private string $idWinner;
    private bool $isFinished;

    //GAME
    private array $game;


    public function __construct(
        string $idGame,
        array $users
        ){
            
        }

    public function saveGame(
        string $idGame,
        array $users,
        string $idWinner,
        bool $isFinished,
        string $gameStatus
    ) : bool
    {
        $this->game = [];
        $this->game['idGame'] = $idGame;
        $this->game['users'] = $users;
        $this->game['idWinner'] = $idWinner;
        $this->game['isFinished'] = $isFinished;
        $this->game['gameStatus'] = $isFinished;

        return true;
    }
};