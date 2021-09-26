<?php

namespace App\Controller;

use App\Games\Game;
use App\Games\Tictactoe;
use App\Games\TictactoeController;
use App\Users\User;
use Symfony\Component\Console\Output\ConsoleOutput;

class TictactoeAppController
{
    private TictactoeController $game;
    private ConsoleOutput $output;
    private User $user1;
    private User $user2;

    public function run()
    {
        $this->output = new ConsoleOutput();
        $this->user1 = new User(1, "User1");
        $this->user2 = new User(2, "User2");
        $users = [
            $this->user1,
            $this->user2
        ];
        $this->game = new TictactoeController($users);
        $this->startGame();
    }

    public function startGame(): void
    {
        $this->output->writeln("<info>Creating a random game...</info>");
        $i = 1;
        $axisX = ["1", "2", "3"];
        $axisY = ["A", "B", "C"];
        $movement["success"] = false;

        do {
            do{
                $player1 = !($i %2 == 0) ? true : false;
                $movement = $this->game->makeMovement(
                    $player1 ? $this->user1 : $this->user2,
                    $axisX[rand(0, 2)],
                    $axisY[rand(0, 2)],
                );
            } while (!$movement["success"]);
            $i++;
            $this->output->writeln("<comment>The player " . ($player1 ? "1" : "2") ."  thinking about his move...</comment>");
            sleep(rand(0,2));
            $this->output->writeln("<comment>Movement done!</comment>");
            $this->output->writeln("<info>Current board status:</info>");
            $this->output->writeln($this->drawstate($movement["board"]->getBoard()));
            
        } while ($movement["status"]["game"] == "playing");

        $emojis = ["( ͡° ͜ʖ ͡°)", "⊙﹏⊙", "(´･_･`)", "(◠﹏◠)", "¯\_(ツ)_/¯", "ᕦ(ò_óˇ)ᕤ", "⊂(◉‿◉)つ"];
        $this->output->writeln("<info>¡¡GAME FINISHED!! ".$emojis[array_rand($emojis,1)]." \n</info>");
        $this->output->writeln("<info>Winner: ". ($player1 ? "Player 1" : "Player 2") ."</info>");
    }

    private function drawstate($board)
    {
        $draw = "";
        $draw = $draw . "-------------\n";
        $draw = $draw . "| ".$this->getBoxValue($board, "1", "A")." | ".$this->getBoxValue($board, "1", "B")." | ".$this->getBoxValue($board, "1", "C")." |\n";
        $draw = $draw . "-------------\n";
        $draw = $draw . "| ".$this->getBoxValue($board, "2", "A")." | ".$this->getBoxValue($board, "2", "B")." | ".$this->getBoxValue($board, "2", "C")." |\n";
        $draw = $draw . "-------------\n";
        $draw = $draw . "| ".$this->getBoxValue($board, "3", "A")." | ".$this->getBoxValue($board, "3", "B")." | ".$this->getBoxValue($board, "3", "C")." |\n";
        $draw = $draw . "-------------\n";
        return $draw;
    }

    private function getBoxValue($board, $x, $y){
        return ($board["$x"]["$y"] == "") ? " " : $board["$x"]["$y"];
    }
}
