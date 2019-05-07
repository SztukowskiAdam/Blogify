<?php

namespace Controllers;

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
        if (Auth::user()) {
            return $this->redirect('admin/dashboard');
        }
        return $this->view->render('users/login');
    }

    public function attempt(): View {
        if (!empty($_POST)) {
            $user = Auth::attempt($_POST['email'], $_POST['password']);

            if ($user) {
                $this->view->user = $user;
                return $this->redirect('admin/dashboard');
            } else {
                $this->view->email = $_POST['email'];
            }
        }
        return $this->view->render('users/login');
    }

    public function dashboard(): View {
        if (Auth::user()) {
            $article = new Article();
            $this->view->countArticles = sizeof($article->getAll());
            $this->view->user = Auth::user();
            return $this->view->render('users/dashboard');
        }
        else return $this->redirect('/');
    }

    public function logout(): View {
        session_destroy();
        return $this->redirect('/');
    }
}