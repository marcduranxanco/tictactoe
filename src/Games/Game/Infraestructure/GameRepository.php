<?php

interface GameRepository
{
    public function saveGame(
        string $idGame,
        array $users,
        string $idWinner,
        bool $isFinished
    ) : bool;
}