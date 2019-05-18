<?php

namespace Models;

use Kernel\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';

    public $id;
    public $title;
    public $content;
    public $slug;
    public $image;
    public $createdAt;
    public $updatedAt;
    public $homePage;
    public $inSlider;
    public $authorId;
    public $accepted;
}