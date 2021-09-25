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
    private string $gameStatus;


    public function __construct()
    {}

    public function saveGame(
        string $idGame,
        array $users,
        string $idWinner,
        bool $isFinished,
        string $gameStatus
    ) : bool
    {
        return true;
    }
};