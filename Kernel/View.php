<?php

namespace Kernel;


class View
{
    /**
     * Composes view with data from all Composers located in Composers directory
     * View constructor.
     */
    public function __construct() {

        foreach (new \DirectoryIterator('Composers') as $fileInfo) {
            if ($fileInfo->getExtension() == 'php') {
                $className = 'Composers\\'.rtrim($fileInfo->getBasename(), '.php');
                $class = new $className();

                foreach (get_object_vars($class->compose()) as $property => $value) {
                    $this->{$property} = $value;
                }
            }
        }
    }

    /**
     * Renders specivic view and layout
     * @param $viewPath
     * @param null $layout
     * @return View
     */
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