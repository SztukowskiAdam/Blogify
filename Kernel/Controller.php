<?php

namespace Kernel;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
}