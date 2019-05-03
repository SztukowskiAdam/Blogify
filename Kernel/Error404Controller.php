<?php

namespace Kernel;

class Error404Controller extends Controller
{
    public function index() {
        $this->view->render('errors/404');
    }
}