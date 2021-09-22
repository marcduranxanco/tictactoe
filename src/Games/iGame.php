<?php

use App\User;

interface iGame
{
    public function setWinner(User $user);
    public function userValidation(array $users);
}