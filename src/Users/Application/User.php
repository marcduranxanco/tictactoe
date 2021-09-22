<?php

namespace App;

class User (interface repository, role){

    protected $name;
    protected $surname;
    protected $wonGames;

    public function __construct($name, $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    public function wonGames()
    {
        return $this->surname;
    }
}