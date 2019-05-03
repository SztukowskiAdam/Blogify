<?php

namespace Controllers;

use Kernel\Auth;
use Kernel\Controller;
use Kernel\View;
use Models\Users;

class UsersController extends Controller
{
    private $model;

    public function __construct() {
        parent::__construct();

        $this->model = new Users();
    }

    public function login(): View {
        if (Auth::user()) {
            return $this->redirect('dashboard');
        }
        return $this->view->render('users/login');
    }

    public function attempt(): View {
        if (!empty($_POST)) {
            $user = Auth::attempt($_POST['email'], $_POST['password']);

            if ($user) {
                $this->view->user = $user;
                return $this->redirect('dashboard');
            } else {
                $this->view->email = $_POST['email'];
            }
        }
        return $this->view->render('users/login');
    }

    public function dashboard(): View {
        if (Auth::user()) {
            $this->view->user = Auth::user();
            return $this->view->render('users/dashboard');
        }
        else return $this->redirect('../');
    }

    public function logout(): View {
        session_destroy();
        return $this->redirect('../');
    }
}