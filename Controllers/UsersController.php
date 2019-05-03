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

    public function index(): View {
        var_dump($_SESSION);
        $this->view->user = $this->model->find(1);
        return $this->view->render('users/index');
    }

    public function login(): View {

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
}