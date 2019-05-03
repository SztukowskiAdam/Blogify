<?php

namespace Kernel;

class Error404Controller extends Controller
{
    /**
     * Method to render 404 not found page
     * @return View
     */
    public function index(): View {
        return $this->view->render('errors/404');
    }
}