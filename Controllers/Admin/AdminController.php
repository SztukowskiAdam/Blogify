<?php

namespace Controllers\Admin;

use Kernel\Auth;
use Kernel\Controller;
use Kernel\View;
use Models\Article;
use Models\Users;

class AdminController extends Controller
{
    private $model;

    public function __construct() {
        parent::__construct();

        $this->model = new Users();
    }

    public function login(): View {
        if (Auth::isAdmin()) {
            return $this->redirect('admin/dashboard');
        }
        return $this->view->render('admin/login/login', 'adminLayout');
    }

    public function attempt(): View {
        if (!empty($_POST)) {
            $user = Auth::attempt($_POST['email'], $_POST['password']);

            if (Auth::isAdmin()) {
                $this->view->user = $user;
                return $this->redirect('admin/dashboard');
            } else {
                $this->view->email = $_POST['email'];
            }
        }
        return $this->view->render('admin/login/login', 'adminLayout');
    }

    public function dashboard(): View {
        if (Auth::isAdmin()) {
            $article = new Article();
            $this->view->countArticles = sizeof($article->getAll());
            $this->view->user = Auth::user();
            return $this->view->render('admin/dashboard/dashboard', 'adminLayout');
        }
        else return $this->redirect('/');
    }

    public function logout(): View {
        if (Auth::isAdmin()) {
            session_destroy();
        }
        return $this->redirect('/');
    }
}