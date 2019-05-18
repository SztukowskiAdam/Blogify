<?php

namespace Models;

use Kernel\Model;

class ArticleComment extends Model
{
    protected $table = 'article_comments';
    protected $primaryKey = 'id';

    public $id;
    public $userId;
    public $articleId;
    public $content;
    public $createdAt;
    public $updatedAt;
}