<?php

namespace Services;

use Models\Users;

class UsersService
{
    private $users;

    public function __construct() {
        $this->users = new Users();
    }
}