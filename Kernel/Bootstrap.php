<?php

namespace Kernel;

class Bootstrap
{
    /**
     * Bootstrap constructor.
     * Here we run controllers and methods based on path
     *
     * We try to recognize path based on paths saved in web.php file
     * And than run specific method
     */
    public function __construct() {
        require_once ('routes/web.php');

        $flag = false;
        $runWithParams = true;
        if (isset($_GET['path'])) {
            if (array_key_exists($_GET['path'], Router::$GET)) {
                $flag = $this->executeMethodWithoutParams($_GET['path']);
            } else {
                // we have some params
                $runWithParams = false;
                $tokens = explode('/', rtrim($_GET['path'], '/'));
                foreach (Router::$GET as $key => $value) {
                    if ($this->executeMethodWithParams($key, $value, $tokens)) {
                        $runWithParams = true;
                    }
                }
            }
        } else {
            // we have index page request
            if (array_key_exists('/', Router::$GET)) {
                $flag = $this->executeMethodWithoutParams('/');
            } else {
                $flag = true;
            }
        }
        if ($flag || !$runWithParams) {
            $controller = new Error404Controller();
            $controller->index();
        }
    }

    /**
     * Attempts to execute method without params
     * @param string $path
     * @return bool
     */
    private function executeMethodWithoutParams(string $path): bool {
        $divider = explode('@', Router::$GET[$path]);

        if (file_exists('Controllers/'.$divider[0].'.php')) {
            $controllerName = 'Controllers\\'.$divider[0];
            $actionName = $divider[1];
            $controller = new $controllerName();

            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                return true;
            }
        } else {
            return true;
        }
        return false;
    }

    /**
     * Attempts to execute method with some params
     * e.g.
     * Route::get('articles/edit/:id', 'ArticlesController@edit');
     * http://localhost/articles/edit/1  <- here parameter is 1
     * @param string $key
     * @param string $value
     * @param array $tokens
     * @return bool
     */
    private function executeMethodWithParams(string $key, string $value, array $tokens): bool {
        if (strpos($key, ':') !== false) {
            $route = explode('/', $key);

            if (sizeof($tokens) === sizeof($route)) {
                $flag = true;
                for ($i = 0; $i < sizeof($tokens); $i++) {
                    if (strpos($route[$i], ':') === false  && $route[$i] !== $tokens[$i]) {
                        $flag = false;
                        break;
                    }
                }

                if ($flag) {
                    $divider = explode('@', $value);
                    if (file_exists('Controllers/'.$divider[0].'.php')) {
                        $controllerName = 'Controllers\\'.$divider[0];
                        $actionName = $divider[1];
                        $controller = new $controllerName();

                        if (method_exists($controller, $actionName)) {
                            $controller->{$actionName}(@array_slice($tokens, substr_count(substr($key, 0, strpos($key, ':')), '/')));
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }
}