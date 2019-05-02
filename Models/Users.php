<?php

namespace Models;

use Kernel\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $timestamps = true;
}
