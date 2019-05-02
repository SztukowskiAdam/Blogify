<?php

namespace Kernel;

class View
{
    public function render($viewPath, $layout = null): View {
        if ($layout === null) {
            $this->view = $viewPath;
            require ('views/layout.php');

        } else if ($layout === false) {
            require ("views/$viewPath.php");

        } else {
            $this->view = $viewPath;
            require ("views/$layout.php");
        }

        return $this;
    }
}