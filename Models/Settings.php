<?php

namespace Models;

use Kernel\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';

    public $id;
    public $backgroundColor;
    public $textColor;
    public $linkColor;

}