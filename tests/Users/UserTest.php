<?php

use PHPUnit\Framework\TestCase;
use App\Users\User;

class UserTest extends TestCase{

    protected $user;

    public function setUp() :void{
        $this->user = new User("1", "User");
    }

    public function testGetName(){
        $this->setUp();
        self::assertEquals("1", $this->user->getId());
    }
}