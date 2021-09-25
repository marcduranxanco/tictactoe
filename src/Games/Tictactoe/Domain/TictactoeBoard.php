<?php

namespace App\Games;

use Exception;
define("CHARS", [1 => 'A', 2 => 'B', 3 => 'C']);

class TictactoeBoard extends Board {

    public function __construct() {
        $board = [];
        $board["1"]["A"] = "";
        $board["1"]["B"] = "";
        $board["1"]["C"] = "";
        $board["2"]["A"] = "";
        $board["2"]["B"] = "";
        $board["2"]["C"] = "";
        $board["3"]["A"] = "";
        $board["3"]["B"] = "";
        $board["3"]["C"] = "";
        parent::__construct($board);

        return $this;
    }

    public function getBoard() {
        return $this->board;
    }

    public function loadBoard(array $board): void
    {
        for ($i=1; $i <= 3; $i++) { 
            if(
                !array_key_exists($i, $board)
                && !array_key_exists("A", $board["$i"])
                && !array_key_exists("B", $board["$i"])
                && !array_key_exists("C", $board["$i"])
            ){
                throw new Exception("The board doesn't match the tic tac toe game", 1);
            }
        }

        $this->board = $board;
    }

    public function makeMovement(int $axisX, string $axisY, string $symbol) : array {
        $success = true;
        $message = "";

        if($axisX < 1 || $axisX > 3){
            $success = false;
            $message = "The axis X is worng";
            throw new Exception($message, 1);
        }

        if(!in_array(strtoupper($axisY), ["A", "B", "C"])){
            $success = false;
            $message = "The axis X is worng";
            throw new Exception($message, 1);
        }

        if(!in_array(strtoupper($symbol), ["O", "X"])){
            $success = false;
            $message = "The symbol is worng";
            throw new Exception($message, 1);
        }

        // Check the cell is empty
        if($this->board[$axisX][strtoupper($axisY)] != ""){
            $success = false;
            $message = "Those coordinates are already written";
        }else{
            $success = true;
            $message = "";
            $this->board[$axisX][strtoupper($axisY)] = strtoupper($symbol);
        }

        $response = [
            "success"       => $success,
            "message"       => $message,
            "status"        => $this->boardStatus(),
            "board"         => $this,
        ];

        return $response;
    }

    private function boardStatus(){
        $success = "";
        $winner = "";
        $gameStatus = "playing";

        for ($i=1; $i <= 3; $i++) { 
            $horizontalStatus = $this->board[$i]["A"].$this->board[$i]["B"].$this->board[$i]["C"];
            if($this->checkSuccess($horizontalStatus)){
                $success = $horizontalStatus;
                break;
            }

            $verticalStatus = $this->board["1"][CHARS[$i]].$this->board["2"][CHARS[$i]].$this->board["3"][CHARS[$i]];
            if($this->checkSuccess($verticalStatus)){
                $success = $verticalStatus;
                break;
            }
        }

        $crossStatus1 = $this->board["1"]["A"].$this->board["2"]["B"].$this->board["3"]["C"];
        if($success == "" && $this->checkSuccess($crossStatus1)){
            $success = $crossStatus1;
        }

        $crossStatus2 = $this->board["1"]["C"].$this->board["2"]["B"].$this->board["3"]["A"];
        if($success == "" && $this->checkSuccess($crossStatus2)){
            $success = $crossStatus2;
        }

        if(!$this->checkIfAnyEmptyBox() && $success == ""){
            $gameStatus = "drawn";
        }

        if($success != "" && $gameStatus != "drawn"){
            $winner = $success[0];
            $gameStatus = "finished";
        }

        $status = [
            "game"    => $gameStatus, //"unstarted", "playing", "drawn", "finished"
            "winner"    => $winner
        ];
        return $status;
    }

    /**
     * Returns true when there is any empty box in the board
     */
    private function checkIfAnyEmptyBox() : bool {
        $empty = false;
        foreach ($this->board as $key => $value) {
            if($value["A"] == "" || $value["B"] == "" || $value["C"] == "" ){
                $empty = true;
                break;
            }
        }
        return $empty;
    }

    private function checkSuccess(string $string) : bool {
        $success = false;
        if(
            strlen($string) == 3 &&
            (count(array_count_values(str_split($string))) == 1)
            ) {
            $success = true;
        }
        return $success;
    }
}