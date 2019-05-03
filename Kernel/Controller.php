<?php

namespace Kernel;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Redirect method
     * @param string $to
     */
    public function redirect(string $to) {
        return header("Location: $to");
    }
}