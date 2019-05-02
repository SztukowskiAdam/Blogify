<?php

namespace Controllers;

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
        $this->view->user = $this->model->find(1);
        return $this->view->render('users/index');
    }

    public function create() {
        echo 'USERS CREATE';
    }

    public function edit() {
        var_dump(func_get_args(0)[0][0]);
        var_dump($this->model->find((int)func_get_args(0)[0][0]));
    }
}