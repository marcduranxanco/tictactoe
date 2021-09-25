<?php

interface GameRepository
{
    public function saveGame(
        string $idGame,
        array $users,
        string $idWinner,
        bool $isFinished,
        string $gameStatus
    ) : bool;
}