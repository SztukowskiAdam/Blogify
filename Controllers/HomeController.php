<?php
namespace Controllers;

use Kernel\Controller;
use Kernel\View;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Renders index view
     * @return View
     */
    public function index(): View {
        return $this->view->render('home/index');
    }
}