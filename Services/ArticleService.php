<?php

namespace Services;

use Models\Article;

class ArticleService
{
    private $article;

    public function __construct() {
        $this->article = new Article();
    }
}