<?php

use App\Games\Tictactoe;
use App\Games\TictactoeBoard;
use PHPUnit\Framework\TestCase;
use App\Games\TictactoeController;

class TictactoeBoardTest extends TestCase
{
    public TictactoeBoard $board;

    protected function setUp(): void {
        $this->board = new TictactoeBoard();
    }

    public function testMakeMovementRight(){
        $this->setUp();
        $movement = $this->board->makeMovement("1", "A", "O");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"] );
    }

    public function testLoadBBoard(){
        $this->setUp();
        $existentBoard = [];
        $existentBoard["1"]["A"] = "X";
        $existentBoard["1"]["B"] = "O";
        $existentBoard["1"]["C"] = "X";
        $existentBoard["2"]["A"] = "X";
        $existentBoard["2"]["B"] = "";
        $existentBoard["2"]["C"] = "";
        $existentBoard["3"]["A"] = "";
        $existentBoard["3"]["B"] = "O";
        $existentBoard["3"]["C"] = "";
        $this->board->loadBoard($existentBoard);
        $loadedBoard = $this->board->getBoard();
        $this->assertIsArray($loadedBoard);
        $this->assertEquals($loadedBoard["1"]["A"], "X");
    }

    public function testRepeatedMovement(){
        $this->setUp();
        $this->board->makeMovement("1", "A", "O");
        $movement = $this->board->makeMovement("1", "A", "O");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"] );
        $this->assertFalse($movement["success"]);
        $this->assertEquals($movement["message"], "Those coordinates are already written");
        $this->assertEquals($movement["status"]["winner"], "");
        $this->assertEquals($movement["status"]["game"], "playing");
    }

    public function testWinHorizontal(){
        $this->setUp();
        $this->board->makeMovement("1", "A", "X");
        $this->board->makeMovement("1", "B", "X");
        $movement = $this->board->makeMovement("1", "C", "X");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"]);
        $this->assertTrue($movement["success"]);
        $this->assertEquals($movement["message"], "");
        $this->assertEquals($movement["status"]["winner"], "X");
        $this->assertEquals($movement["status"]["game"], "finished");

        $this->setUp();
        $this->board->makeMovement("2", "A", "X");
        $this->board->makeMovement("2", "B", "X");
        $movement = $this->board->makeMovement("2", "C", "X");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"]);
        $this->assertTrue($movement["success"]);
        $this->assertEquals($movement["message"], "");
        $this->assertEquals($movement["status"]["winner"], "X");
        $this->assertEquals($movement["status"]["game"], "finished");

        $this->setUp();
        $this->board->makeMovement("3", "A", "O");
        $this->board->makeMovement("3", "B", "O");
        $movement = $this->board->makeMovement("3", "C", "O");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"]);
        $this->assertTrue($movement["success"]);
        $this->assertEquals($movement["message"], "");
        $this->assertEquals($movement["status"]["winner"], "O");
        $this->assertEquals($movement["status"]["game"], "finished");
    }

    public function testWinVertical(){
        $this->setUp();
        $this->board->makeMovement("1", "A", "X");
        $this->board->makeMovement("2", "A", "X");
        $movement = $this->board->makeMovement("3", "A", "X");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"]);
        $this->assertTrue($movement["success"]);
        $this->assertEquals($movement["message"], "");
        $this->assertEquals($movement["status"]["winner"], "X");
        $this->assertEquals($movement["status"]["game"], "finished");

        $this->setUp();
        $this->board->makeMovement("1", "B", "X");
        $this->board->makeMovement("2", "B", "X");
        $movement = $this->board->makeMovement("3", "B", "X");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"]);
        $this->assertTrue($movement["success"]);
        $this->assertEquals($movement["message"], "");
        $this->assertEquals($movement["status"]["winner"], "X");
        $this->assertEquals($movement["status"]["game"], "finished");

        $this->setUp();
        $this->board->makeMovement("1", "C", "O");
        $this->board->makeMovement("2", "C", "O");
        $movement = $this->board->makeMovement("3", "C", "O");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"]);
        $this->assertTrue($movement["success"]);
        $this->assertEquals($movement["message"], "");
        $this->assertEquals($movement["status"]["winner"], "O");
        $this->assertEquals($movement["status"]["game"], "finished");
    }

    public function testWinDiagonal(){
        $this->setUp();
        $this->board->makeMovement("1", "A", "X");
        $this->board->makeMovement("2", "B", "X");
        $movement = $this->board->makeMovement("3", "C", "X");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"]);
        $this->assertTrue($movement["success"]);
        $this->assertEquals($movement["message"], "");
        $this->assertEquals($movement["status"]["winner"], "X");
        $this->assertEquals($movement["status"]["game"], "finished");

        $this->setUp();
        $this->board->makeMovement("1", "C", "O");
        $this->board->makeMovement("2", "B", "O");
        $movement = $this->board->makeMovement("3", "A", "O");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"]);
        $this->assertTrue($movement["success"]);
        $this->assertEquals($movement["message"], "");
        $this->assertEquals($movement["status"]["winner"], "O");
        $this->assertEquals($movement["status"]["game"], "finished");
    }

    public function testDrawnMatch(){
        $this->setUp();
        $this->board->makeMovement("1", "A", "X");
        $this->board->makeMovement("1", "B", "O");
        $this->board->makeMovement("1", "C", "X");
        $this->board->makeMovement("2", "A", "O");
        $this->board->makeMovement("2", "B", "O");
        $this->board->makeMovement("2", "C", "X");
        $this->board->makeMovement("3", "A", "O");
        $this->board->makeMovement("3", "B", "X");
        $movement = $this->board->makeMovement("3", "C", "O");
        $this->assertInstanceOf( TictactoeBoard::class, $movement["board"]);
        $this->assertEquals($movement["status"]["game"], "drawn");
        $this->assertEquals($movement["status"]["winner"], "");
    }

        /**
         * Get the value of existentBoard
         */ 
        public function getExistentBoard()
        {
                return $this->existentBoard;
        }

        /**
         * Set the value of existentBoard
         *
         * @return  self
         */ 
        public function setExistentBoard($existentBoard)
        {
                $this->existentBoard = $existentBoard;

                return $this;
        }
}