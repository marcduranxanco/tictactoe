<?php

namespace App\Users;

/**
 * @params Repository interface
 */
class User {

    protected string $id;
    protected string $name;

    public function __construct(
        string $p_id,
        string $p_name)
    {
        $this->name = $p_name;
        $this->id = $p_id;
    }

    public function getId() : string
    {
        return $this->id;
    }
};