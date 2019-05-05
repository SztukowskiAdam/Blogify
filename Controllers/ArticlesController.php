<?php

namespace Controllers;

use Kernel\Auth;
use Kernel\Controller;
use Kernel\View;
use Models\Article;

class ArticlesController extends Controller
{
    private $articles;

    public function __construct() {
        parent::__construct();

        $this->articles = new Article();
    }

    public function index(): View {
        $this->view->articles = $this->articles->getAll();
        return $this->view->render('articles/index');
    }

    public function show(): View {
        $slug = func_get_args()[0];
        $article = $this->articles->where('slug', '=', $slug);

        if (!empty($article)) {
            $this->view->article = (object) $article[0];
            return $this->view->render('articles/show');
        }
        return $this->redirect('/');
    }

    public function adminIndex(): View {
        if (Auth::user()) {
            $this->view->articles = $this->articles->getAll();
            return $this->view->render('articles/admin/index');
        }
        return $this->redirect('/');
    }

    public function edit(): View {
        if (Auth::user()) {
            $this->view->article = $this->articles->find((int)func_get_args()[0]);
            return $this->view->render('articles/admin/form');
        }
        return $this->redirect('/');
    }
}