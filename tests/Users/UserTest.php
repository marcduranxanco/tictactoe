<?php

use PHPUnit\Framework\TestCase;
use App\Users\User;

class UserTest extends TestCase{

    protected $user;

    public function setUp() :void{
        $this->user = new User("1234abcd", "User");
    }

    public function testGetName(){
        $this->setUp();
        self::assertEquals("User", $this->user->getName());
    }
}