<?php

namespace App\Games;

use GameRepository;
class Tictactoe extends Game
{
    public function __construct(
        Array $p_users,
        GameRepository $p_gameRepository
    ) {
        parent::__construct($p_users, 2, 2, $p_gameRepository);
    }
}
