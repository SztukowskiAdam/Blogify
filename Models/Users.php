<?php

namespace Models;

use Kernel\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public $id;
    public $name;
    public $password;
    public $email;
    public $isAdmin;
    public $createdAt;
    public $updatedAt;
}
