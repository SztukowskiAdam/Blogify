<?php

namespace Models;

use Kernel\Model;

class ArticleRating extends Model
{
    protected $table = 'article_rating';
    protected $primaryKey = 'id';

    public $id;
    public $userId;
    public $articleId;
    public $ratio;
    public $createdAt;
    public $updatedAt;
}