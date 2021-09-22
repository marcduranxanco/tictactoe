<?php

namespace Test\Games;

use GameRepository;

/**
 * @params Repository interface
 */
class GameTestRepository implements GameRepository {

    private string $idGame;
    private array $users;
    private string $idWinner;
    private bool $isFinished;


    public function __construct(string $idGame, array $users, string $idWinner, bool $isFinished)
    {
        $this->idGame = $idGame;
        $this->users = $users;
        $this->idWinner = $idWinner;
        $this->isFinished = $isFinished;
    }

    public function saveGame(
        string $idGame,
        array $users,
        string $idWinner,
        bool $isFinished
    ) : bool
    {
        return true;
    }
};