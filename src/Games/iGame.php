<?php

use App\Users\User;

interface iGame
{
    public function userValidation() : bool;
    public function setWinner(User $user);
    public function setNewStatus(string $string) : void;
}