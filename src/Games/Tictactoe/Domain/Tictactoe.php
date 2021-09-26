<?php

namespace App\Games;

use GameRepository;
class Tictactoe extends Game
{
    public TictactoeBoard $board;

    public function __construct(
        Array $p_users,
        GameRepository $p_gameRepository,
        TictactoeBoard $p_board
    ) {
        $this->board = $p_board;
        parent::__construct($p_users, 2, 2, $p_gameRepository);
    }

    
}
