<?php

namespace App\Games;

use App\Games\Tictactoe;
use App\Games\InMemoryRepository;
use App\Users\User;
use Exception;

class TictactoeController
{
    private Tictactoe $game;
    private array $users;
    private User $userX;
    private User $userO;
    private TictactoeBoard $board;

    public function __construct(array $p_users)
    {
        $this->userX = $p_users[0];
        $this->userO = $p_users[1];
        $this->users = [$this->userX, $this->userO];
        $this->board = new TictactoeBoard();
        $this->game = new Tictactoe($this->users, new InMemoryRepository(), $this->board);
    }

    public function makeMovement(User $user, int $axisX, string $axisY) : Array {
      if(!in_array($user, $this->users))
        throw new Exception("The user is not in this game", 1);

      $symbol = $user->getId() == $this->userX->getId() ? "X" : "O";

      return $this->board->makeMovement($axisX, $axisY, $symbol);
    }
}