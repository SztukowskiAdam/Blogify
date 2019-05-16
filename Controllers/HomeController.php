<?php
namespace Controllers;

use Kernel\Controller;
use Kernel\View;
use Models\Article;

class HomeController extends Controller
{
    private $articles;

    public function __construct()
    {
        parent::__construct();

        $this->articles = new Article();
    }

    /**
     * Renders index view
     * @return View
     */
    public function index(): View {
        $this->view->articles = $this->articles->where('homePage', '=', 1, 'createdAt', 'DESC');
        return $this->view->render('home/index');
    }

    public function articles(): View {
        $this->view->articles = $this->articles->getAll('createdAt', 'DESC');
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
}