<?php
namespace Controllers;

use Kernel\Controller;
use Kernel\View;
use Models\Article;

class HomeController extends Controller
{
    private $article;

    public function __construct()
    {
        parent::__construct();

        $this->article = new Article();
    }

    /**
     * Renders index view
     * @return View
     */
    public function index(): View {
        $this->view->articles = $this->article->where('homePage', '=', 1);
        return $this->view->render('home/index');
    }
}