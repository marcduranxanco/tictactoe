<?php

namespace App\Games;

use GameRepository;

class InMemoryRepository implements GameRepository {

    private string $idGame;
    private array $users;
    private string $idWinner;
    private bool $isFinished;


    public function __construct()
    {}

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