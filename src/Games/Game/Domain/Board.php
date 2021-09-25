<?php

namespace App\Games;

use Exception;

class Board {
    protected array $board;

    public function __construct(array $Board) {
        $this->board = $Board;
    }
}